-- Shared Escape room settings. Existing admins table remains unchanged.
begin;
create table public.escape_room_config (
 id smallint primary key default 1 check (id=1),
 numeric_code text not null check (numeric_code ~ '^[0-9]{1,32}$'),
 letters_code text not null check (letters_code ~ '^[A-ZĄĆĘŁŃÓŚŹŻ]{1,32}$'),
 mixed_code text not null check (mixed_code ~ '^[A-ZĄĆĘŁŃÓŚŹŻ0-9]{1,32}$'),
 teacher_pin text not null check (teacher_pin ~ '^[0-9]{4,12}$'),
 success_message text not null check (char_length(success_message) between 1 and 160),
 revision integer not null default 1,
 updated_at timestamptz not null default now()
);
alter table public.escape_room_config enable row level security;
revoke all on public.escape_room_config from anon, authenticated;
grant select on public.escape_room_config to authenticated;
create policy "Escape room admin read" on public.escape_room_config for select to authenticated
 using (exists(select 1 from public.admins where id=(select auth.uid())));
insert into public.escape_room_config (numeric_code,letters_code,mixed_code,teacher_pin,success_message)
 values ('314','KOD','KOD7', (floor(random()*900000)+100000)::integer::text,'Kod poprawny! Możecie przejść do kolejnego etapu.');

create function public.escape_room_verify(p_mode text,p_code text) returns jsonb
 language plpgsql security definer set search_path='' as $$
declare c public.escape_room_config; expected text; actual text;
begin
 if p_mode is null or p_mode not in ('numeric','letters','mixed') or p_code is null or char_length(p_code) not between 1 and 32 then
  return jsonb_build_object('correct',false);
 end if;
 select * into strict c from public.escape_room_config where id=1;
 expected := case p_mode when 'numeric' then c.numeric_code when 'letters' then c.letters_code else c.mixed_code end;
 actual := normalize(upper(p_code), NFC);
 if actual=expected then return jsonb_build_object('correct',true,'message',c.success_message); end if;
 return jsonb_build_object('correct',false);
end; $$;

create function public.escape_room_read(p_pin text default null) returns jsonb
 language plpgsql security definer set search_path='' as $$
declare c public.escape_room_config; is_admin boolean;
begin
 is_admin := exists(select 1 from public.admins where id=auth.uid());
 select * into strict c from public.escape_room_config where id=1;
 if not is_admin and (p_pin is null or p_pin<>c.teacher_pin) then raise exception 'Nieprawidłowy PIN lub brak uprawnień.' using errcode='42501'; end if;
 return jsonb_build_object('numeric',c.numeric_code,'letters',c.letters_code,'mixed',c.mixed_code,'message',c.success_message,'revision',c.revision,'isAdmin',is_admin,'pin',case when is_admin then c.teacher_pin else null end);
end; $$;

create function public.escape_room_save(p_numeric text,p_letters text,p_mixed text,p_message text,p_revision integer,p_pin text default null,p_new_pin text default null) returns jsonb
 language plpgsql security definer set search_path='' as $$
declare c public.escape_room_config; is_admin boolean;
begin
 is_admin := exists(select 1 from public.admins where id=auth.uid());
 select * into strict c from public.escape_room_config where id=1 for update;
 if not is_admin and (p_pin is null or p_pin<>c.teacher_pin) then raise exception 'Nieprawidłowy PIN lub brak uprawnień.' using errcode='42501'; end if;
 if p_new_pin is not null and not is_admin then raise exception 'PIN może zmienić tylko administrator.' using errcode='42501'; end if;
 if p_revision is distinct from c.revision then raise exception 'Ustawienia zmieniono w innym oknie. Wczytaj je ponownie przed zapisem.' using errcode='40001'; end if;
 update public.escape_room_config set numeric_code=normalize(upper(trim(p_numeric)), NFC),letters_code=normalize(upper(trim(p_letters)), NFC),mixed_code=normalize(upper(trim(p_mixed)), NFC),success_message=trim(p_message),teacher_pin=coalesce(p_new_pin,c.teacher_pin),revision=revision+1,updated_at=now() where id=1;
 return public.escape_room_read(case when is_admin then null else p_pin end);
end; $$;
revoke all on function public.escape_room_verify(text,text), public.escape_room_read(text), public.escape_room_save(text,text,text,text,integer,text,text) from public;
grant execute on function public.escape_room_verify(text,text), public.escape_room_read(text), public.escape_room_save(text,text,text,text,integer,text,text) to anon, authenticated;
commit;
