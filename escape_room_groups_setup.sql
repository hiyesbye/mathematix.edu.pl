-- Extends the existing installation with independent configurations for groups 1–6.
begin;
create table public.escape_room_groups (
 group_id smallint primary key check (group_id between 1 and 6),
 numeric_code text not null check (numeric_code ~ '^[0-9]{1,32}$'),
 letters_code text not null check (letters_code ~ '^[A-ZĄĆĘŁŃÓŚŹŻ]{1,32}$'),
 mixed_code text not null check (mixed_code ~ '^[A-ZĄĆĘŁŃÓŚŹŻ0-9]{1,32}$'),
 success_message text not null check (char_length(success_message) between 1 and 160),
 revision integer not null default 1,
 updated_at timestamptz not null default now()
);
alter table public.escape_room_groups enable row level security;
revoke all on public.escape_room_groups from anon,authenticated;
grant select on public.escape_room_groups to authenticated;
create policy "Escape room groups admin read" on public.escape_room_groups for select to authenticated
 using (exists(select 1 from public.admins where id=(select auth.uid())));
-- Preserve existing codes in every group; teachers can then edit each tab independently.
insert into public.escape_room_groups(group_id,numeric_code,letters_code,mixed_code,success_message,revision)
 select n,c.numeric_code,c.letters_code,c.mixed_code,c.success_message,c.revision
 from public.escape_room_config c cross join generate_series(1,6) n where c.id=1;

create function public.escape_room_group_verify(p_group integer,p_mode text,p_code text) returns jsonb
 language plpgsql security definer set search_path='' as $$
declare c public.escape_room_groups; expected text;
begin
 if p_group is null or p_group not between 1 and 6 or p_mode is null or p_mode not in ('numeric','letters','mixed') or p_code is null or char_length(p_code) not between 1 and 32 then
  return jsonb_build_object('correct',false);
 end if;
 select * into strict c from public.escape_room_groups where group_id=p_group;
 expected:=case p_mode when 'numeric' then c.numeric_code when 'letters' then c.letters_code else c.mixed_code end;
 if normalize(upper(p_code),NFC)=expected then return jsonb_build_object('correct',true,'message',c.success_message); end if;
 return jsonb_build_object('correct',false);
end; $$;

create function public.escape_room_groups_read(p_pin text default null) returns jsonb
 language plpgsql security definer set search_path='' as $$
declare c public.escape_room_config; is_admin boolean; groups_data jsonb;
begin
 is_admin:=exists(select 1 from public.admins where id=auth.uid());
 select * into strict c from public.escape_room_config where id=1;
 if not is_admin and (p_pin is null or p_pin<>c.teacher_pin) then raise exception 'Nieprawidłowy PIN lub brak uprawnień.' using errcode='42501'; end if;
 select jsonb_agg(jsonb_build_object('group',group_id,'numeric',numeric_code,'letters',letters_code,'mixed',mixed_code,'message',success_message,'revision',revision) order by group_id)
 into groups_data from public.escape_room_groups;
 return jsonb_build_object('groups',groups_data,'isAdmin',is_admin,'pin',case when is_admin then c.teacher_pin else null end,'pinRevision',c.revision);
end; $$;

create function public.escape_room_group_save(p_group integer,p_numeric text,p_letters text,p_mixed text,p_message text,p_revision integer,p_pin text default null,p_new_pin text default null,p_pin_revision integer default null) returns jsonb
 language plpgsql security definer set search_path='' as $$
declare c public.escape_room_config; g public.escape_room_groups; is_admin boolean;
begin
 if p_group is null or p_group not between 1 and 6 then raise exception 'Nieprawidłowa grupa.' using errcode='22023'; end if;
 is_admin:=exists(select 1 from public.admins where id=auth.uid());
 -- Consistent locking order also serializes PIN changes against teacher saves.
 select * into strict c from public.escape_room_config where id=1 for update;
 if not is_admin and (p_pin is null or p_pin<>c.teacher_pin) then raise exception 'Nieprawidłowy PIN lub brak uprawnień.' using errcode='42501'; end if;
 if p_new_pin is not null and not is_admin then raise exception 'PIN może zmienić tylko administrator.' using errcode='42501'; end if;
 if p_new_pin is not null and p_new_pin<>c.teacher_pin and p_pin_revision is distinct from c.revision then raise exception 'PIN zmieniono w innym oknie. Wczytaj ustawienia ponownie.' using errcode='40001'; end if;
 select * into strict g from public.escape_room_groups where group_id=p_group for update;
 if p_revision is distinct from g.revision then raise exception 'Kody tej grupy zmieniono w innym oknie. Wczytaj ustawienia ponownie.' using errcode='40001'; end if;
 update public.escape_room_groups set numeric_code=normalize(upper(trim(p_numeric)),NFC),letters_code=normalize(upper(trim(p_letters)),NFC),mixed_code=normalize(upper(trim(p_mixed)),NFC),success_message=trim(p_message),revision=revision+1,updated_at=now() where group_id=p_group;
 if p_new_pin is not null and p_new_pin<>c.teacher_pin then
  update public.escape_room_config set teacher_pin=p_new_pin,revision=revision+1,updated_at=now() where id=1;
 end if;
 return public.escape_room_groups_read(case when is_admin then null else p_pin end);
end; $$;

-- Backward-compatible endpoints for already-open browser tabs: they use group 1.
create or replace function public.escape_room_verify(p_mode text,p_code text) returns jsonb
 language sql security definer set search_path='' as $$ select public.escape_room_group_verify(1,p_mode,p_code); $$;
create or replace function public.escape_room_read(p_pin text default null) returns jsonb
 language plpgsql security definer set search_path='' as $$
declare result jsonb;
begin
 result:=public.escape_room_groups_read(p_pin);
 return (result->'groups'->0)||jsonb_build_object('isAdmin',result->'isAdmin','pin',result->'pin');
end; $$;
create or replace function public.escape_room_save(p_numeric text,p_letters text,p_mixed text,p_message text,p_revision integer,p_pin text default null,p_new_pin text default null) returns jsonb
 language plpgsql security definer set search_path='' as $$
declare result jsonb; pin_version integer;
begin
 select revision into pin_version from public.escape_room_config where id=1;
 result:=public.escape_room_group_save(1,p_numeric,p_letters,p_mixed,p_message,p_revision,p_pin,p_new_pin,pin_version);
 return (result->'groups'->0)||jsonb_build_object('isAdmin',result->'isAdmin','pin',result->'pin');
end; $$;
revoke all on function public.escape_room_group_verify(integer,text,text),public.escape_room_groups_read(text),public.escape_room_group_save(integer,text,text,text,text,integer,text,text,integer) from public;
grant execute on function public.escape_room_group_verify(integer,text,text),public.escape_room_groups_read(text),public.escape_room_group_save(integer,text,text,text,text,integer,text,text,integer) to anon,authenticated;
commit;
