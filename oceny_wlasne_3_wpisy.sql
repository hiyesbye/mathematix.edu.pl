-- Krok 3 z 4: stopnie widzi właściciel i admin; wpisuje tylko admin.
alter table public.oceny_wlasne_uczniow enable row level security;
revoke all on public.oceny_wlasne_uczniow from anon, authenticated;
grant select, insert, update on public.oceny_wlasne_uczniow to authenticated;

drop policy if exists oceny_wlasne_uczniow_odczyt on public.oceny_wlasne_uczniow;
create policy oceny_wlasne_uczniow_odczyt on public.oceny_wlasne_uczniow
for select to authenticated using (
  profil_id = auth.uid() or exists (select 1 from public.admins where id = auth.uid())
);
drop policy if exists oceny_wlasne_uczniow_admin_insert on public.oceny_wlasne_uczniow;
create policy oceny_wlasne_uczniow_admin_insert on public.oceny_wlasne_uczniow
for insert to authenticated with check (
  exists (select 1 from public.admins where id = auth.uid())
);
drop policy if exists oceny_wlasne_uczniow_admin_update on public.oceny_wlasne_uczniow;
create policy oceny_wlasne_uczniow_admin_update on public.oceny_wlasne_uczniow
for update to authenticated
using (exists (select 1 from public.admins where id = auth.uid()))
with check (exists (select 1 from public.admins where id = auth.uid()));
