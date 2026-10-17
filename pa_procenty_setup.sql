-- Uruchom raz w Supabase SQL Editor przed publikacją nowego panelu.
-- 1 p.p. kupiony za 1 PA. Punkty zdobyte na pracy pozostają bez zmian.
create table if not exists public.pa_procenty (
  profil_id uuid not null references public.profiles(id) on delete cascade,
  typ text not null check (typ in ('kartkowka', 'praca_kontrolna')),
  numer integer not null check ((typ = 'kartkowka' and numer between 1 and 8)
                             or (typ = 'praca_kontrolna' and numer between 1 and 4)),
  punkty_procentowe integer not null default 0 check (punkty_procentowe between 0 and 100),
  primary key (profil_id, typ, numer)
);

alter table public.pa_procenty enable row level security;
revoke all on public.pa_procenty from anon, authenticated;
grant select on public.pa_procenty to authenticated;
drop policy if exists "pa_procenty_read_own_or_admin" on public.pa_procenty;
create policy "pa_procenty_read_own_or_admin" on public.pa_procenty
  for select to authenticated
  using (profil_id = auth.uid() or exists
    (select 1 from public.admins where id = auth.uid()));

alter table public.pa_zakupy add column if not exists z_plusem integer not null default 0;
-- Zachowaj punkty wpisane wcześniej ręcznie, jeśli takie istnieją.
do $migration$
begin
  if not exists (select 1 from information_schema.columns
                 where table_schema = 'public' and table_name = 'pa_zakupy'
                   and column_name = 'z_plusem_wczesniej') then
    alter table public.pa_zakupy
      add column z_plusem_wczesniej integer not null default 0;
    update public.pa_zakupy set z_plusem_wczesniej = z_plusem;
  end if;
end;
$migration$;

-- Jedyna ścieżka zmiany: sprawdza uprawnienia, próg (+), limit i przelicza
-- zakup, saldo PA oraz ocenę w jednej transakcji.
create or replace function public.pa_zmien_procent(
  p_profil uuid, p_typ text, p_numer integer, p_zmiana integer
) returns integer language plpgsql security definer
set search_path = public, pg_temp as $$
declare
  v_pkt numeric;
  v_max numeric;
  v_procent integer;
  v_cel integer;
  v_stare integer;
  v_nowe integer;
  v_ocena integer;
  v_pole text;
  v_saldo integer;
begin
  if auth.uid() is null or not exists
    (select 1 from public.admins where id = auth.uid()) then
    raise exception 'Brak uprawnień admina';
  end if;
  if p_profil is null or p_zmiana is null or p_zmiana not in (-1, 1) or
     p_typ is null or p_numer is null or
     not ((p_typ = 'kartkowka' and p_numer between 1 and 8) or
          (p_typ = 'praca_kontrolna' and p_numer between 1 and 4)) then
    raise exception 'Nieprawidłowe parametry';
  end if;
  v_pole := case when p_typ = 'kartkowka' then 'kartkowka_'
                  else 'praca_kontrolna_' end || p_numer;

  perform pg_advisory_xact_lock(hashtext(p_profil::text));
  select case when p_typ = 'kartkowka'
           then (to_jsonb(p)->>('kartp' || p_numer))::numeric
           else (to_jsonb(p)->>('klasp' || p_numer))::numeric end,
         case when p_typ = 'kartkowka'
           then (to_jsonb(p)->>('kartmax' || p_numer))::numeric
           else (to_jsonb(p)->>('klasmax' || p_numer))::numeric end
    into v_pkt, v_max from public."Punktysem1" p where p.profil_id = p_profil;
  select punkty_procentowe into v_stare from public.pa_procenty
    where profil_id = p_profil and typ = p_typ and numer = p_numer;
  v_stare := coalesce(v_stare, 0);
  if v_pkt is null or v_max is null or v_max <= 0 then
    if p_zmiana > 0 then raise exception 'Ta praca nie ma kompletnych punktów'; end if;
    v_procent := null;
  else
    v_procent := round(v_pkt::numeric / v_max * 100)::integer;
    if v_procent < 0 or v_procent > 100 then
      if p_zmiana > 0 then raise exception 'Nieprawidłowy procent pracy'; end if;
      v_procent := null;
    end if;
  end if;
  v_cel := case
    when v_procent between 20 and 29 then 30
    when v_procent between 40 and 49 then 50
    when v_procent between 60 and 69 then 70
    when v_procent between 80 and 86 then 87
    when v_procent between 91 and 96 then 97
    else null end;
  if p_zmiana > 0 and v_stare = 0 then
    select (to_jsonb(s)->>v_pole)::integer into v_ocena
      from public.semestr1 s where s.profil_id = p_profil;
    if v_ocena is distinct from (case when v_procent < 30 then 1
      when v_procent < 50 then 2 when v_procent < 70 then 3
      when v_procent < 87 then 4 when v_procent < 97 then 5 else 6 end) then
      raise exception 'Ocena nie odpowiada punktom tej pracy';
    end if;
  end if;
  v_nowe := v_stare + p_zmiana;
  if v_nowe < 0 then raise exception 'Nie ma punktów do odjęcia'; end if;
  if p_zmiana > 0 and (v_cel is null or v_nowe > v_cel - v_procent) then
    raise exception 'Przekroczono próg następnej oceny lub brak oznaczenia (+)';
  end if;
  if p_zmiana > 0 then
    select coalesce(s.punkty_aktywnosci, 0) + coalesce(z.wirtualne, 0)
      - coalesce(z.z_plusem, 0) - 5 * coalesce(z.bdb, 0)
      - 10 * coalesce(z.cel, 0) - 2 * coalesce(z.poprawa_kartkowki, 0)
      - 4 * coalesce(z.poprawa_klasowki, 0) - 5 * coalesce(z.poprawa_odpowiedzi, 0)
      - 10 * coalesce(z.np_jednorazowe, 0) - 30 * coalesce(z.np_tygodniowe, 0)
      into v_saldo from public.semestr1 s
      left join public.pa_zakupy z on z.profil_id = s.profil_id
      where s.profil_id = p_profil;
    if coalesce(v_saldo, 0) < 1 then
      raise exception 'Uczeń nie ma wystarczającej liczby Punktów Aktywności';
    end if;
  end if;

  insert into public.pa_procenty (profil_id, typ, numer, punkty_procentowe)
    values (p_profil, p_typ, p_numer, v_nowe)
    on conflict (profil_id, typ, numer) do update
      set punkty_procentowe = excluded.punkty_procentowe;

  insert into public.pa_zakupy as zakup (profil_id, z_plusem)
    values (p_profil, (select coalesce(sum(punkty_procentowe), 0)
                       from public.pa_procenty where profil_id = p_profil))
    on conflict (profil_id) do update set z_plusem =
      zakup.z_plusem_wczesniej + excluded.z_plusem;

  if v_procent is not null then
    v_ocena := case when least(100, v_procent + v_nowe) < 30 then 1
      when least(100, v_procent + v_nowe) < 50 then 2
      when least(100, v_procent + v_nowe) < 70 then 3
      when least(100, v_procent + v_nowe) < 87 then 4
      when least(100, v_procent + v_nowe) < 97 then 5 else 6 end;
  end if;
  execute format('insert into public.semestr1 (profil_id, %I) values ($1, $2)
    on conflict (profil_id) do update set %I = excluded.%I', v_pole, v_pole, v_pole)
    using p_profil, v_ocena;
  return v_nowe;
end;
$$;

revoke all on function public.pa_zmien_procent(uuid, text, integer, integer) from public;
grant execute on function public.pa_zmien_procent(uuid, text, integer, integer) to authenticated;
