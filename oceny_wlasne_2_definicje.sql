-- Krok 2 z 4: definicje widoczne w swojej klasie, edycja tylko dla admina.
alter table public.oceny_wlasne enable row level security;
revoke all on public.oceny_wlasne from anon, authenticated;
grant select, insert, update, delete on public.oceny_wlasne to authenticated;

drop policy if exists oceny_wlasne_odczyt on public.oceny_wlasne;
create policy oceny_wlasne_odczyt on public.oceny_wlasne
for select to authenticated using (
  exists (select 1 from public.admins where id = auth.uid())
  or exists (select 1 from public.profiles
             where id = auth.uid() and klasa = oceny_wlasne.klasa)
);
drop policy if exists oceny_wlasne_admin_insert on public.oceny_wlasne;
create policy oceny_wlasne_admin_insert on public.oceny_wlasne
for insert to authenticated with check (
  exists (select 1 from public.admins where id = auth.uid())
);
drop policy if exists oceny_wlasne_admin_update on public.oceny_wlasne;
create policy oceny_wlasne_admin_update on public.oceny_wlasne
for update to authenticated
using (exists (select 1 from public.admins where id = auth.uid()))
with check (exists (select 1 from public.admins where id = auth.uid()));
