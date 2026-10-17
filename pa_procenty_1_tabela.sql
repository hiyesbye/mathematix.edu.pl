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

