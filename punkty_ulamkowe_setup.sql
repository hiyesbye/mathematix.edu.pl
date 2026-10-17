-- Jedno polecenie do uruchomienia w Supabase SQL Editor.
-- Zapisuje definicję i uprawnienia widoku, zmienia punkty na numeric i odtwarza widok.
do $migration$
declare
  v_definicja text;
  v_opcje text[];
  v_wlasciciel oid;
  v_uprawnienia aclitem[];
  v_komentarz text;
  r record;
begin
  perform set_config('search_path', 'public,pg_temp', true);
  select pg_get_viewdef(c.oid, true), c.reloptions, c.relowner, c.relacl,
         obj_description(c.oid, 'pg_class')
    into strict v_definicja, v_opcje, v_wlasciciel, v_uprawnienia, v_komentarz
    from pg_class c join pg_namespace n on n.oid = c.relnamespace
   where n.nspname = 'public' and c.relname = 'Punktysem1_widok'
     and c.relkind = 'v';

  execute 'drop view public."Punktysem1_widok"';
  execute $alter$alter table public."Punktysem1"
    alter column kartp1 type numeric(10,2),
    alter column kartmax1 type numeric(10,2),
    alter column kartp2 type numeric(10,2),
    alter column kartmax2 type numeric(10,2),
    alter column kartp3 type numeric(10,2),
    alter column kartmax3 type numeric(10,2),
    alter column kartp4 type numeric(10,2),
    alter column kartmax4 type numeric(10,2),
    alter column kartp5 type numeric(10,2),
    alter column kartmax5 type numeric(10,2),
    alter column kartp6 type numeric(10,2),
    alter column kartmax6 type numeric(10,2),
    alter column kartp7 type numeric(10,2),
    alter column kartmax7 type numeric(10,2),
    alter column kartp8 type numeric(10,2),
    alter column kartmax8 type numeric(10,2),
    alter column klasp1 type numeric(10,2),
    alter column klasmax1 type numeric(10,2),
    alter column klasp2 type numeric(10,2),
    alter column klasmax2 type numeric(10,2),
    alter column klasp3 type numeric(10,2),
    alter column klasmax3 type numeric(10,2),
    alter column klasp4 type numeric(10,2),
    alter column klasmax4 type numeric(10,2)$alter$;
  execute format('create view public."Punktysem1_widok" %s as %s',
    case when v_opcje is null then ''
         else 'with (' || array_to_string(v_opcje, ', ') || ')' end,
    v_definicja);
  execute format('alter view public."Punktysem1_widok" owner to %I',
                 pg_get_userbyid(v_wlasciciel));
  for r in select grantee, privilege_type, is_grantable
             from aclexplode(v_uprawnienia) where grantee <> v_wlasciciel
  loop
    execute format('grant %s on public."Punktysem1_widok" to %s%s',
      r.privilege_type,
      case when r.grantee = 0 then 'public'
           else format('%I', pg_get_userbyid(r.grantee)) end,
      case when r.is_grantable then ' with grant option' else '' end);
  end loop;
  if v_komentarz is not null then
    execute format('comment on view public."Punktysem1_widok" is %L', v_komentarz);
  end if;
end;
$migration$;
