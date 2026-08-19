-- Uruchom ten skrypt raz w Supabase: Dashboard -> SQL Editor -> New query -> wklej -> Run.
-- Tworzy tabelę do przechowywania "wydatków" Punktów Aktywności (wszystko,
-- co uczeń wymienił w sklepiku) oraz "wirtualnych" punktów (przyznanych,
-- ale jeszcze nie oddanych fizycznie w klasie).
--
-- Sam licznik ogólny ("Overall") zostaje tam, gdzie już jest —
-- w semestr1.punkty_aktywnosci — żeby nie migrować istniejących danych.
-- Saldo = Overall - (wydatki * cennik) + wirtualne, liczone w locie w apce,
-- dokładnie według wzoru z Twojego Excela:
--   Saldo = Pkt.akt. - 5*bdb - 10*cel - 2*poprawa_kartkowki - 4*poprawa_klasowki
--           - 5*poprawa_odpowiedzi - 10*np_jednorazowe - 30*np_tygodniowe + wirtualne
-- (ceny za bdb/cel/poprawy wzięte z aktualnego sklepik.html; w Twoim Excelu
-- było tylko jedno ogólne "Np." @5 — tutaj rozbite na jednorazowe @10 i
-- tygodniowe @30, zgodnie z tym, co już oferuje sklepik).

-- 1) Tabela
create table if not exists public.pa_zakupy (
  profil_id uuid primary key references public.profiles(id) on delete cascade,
  bdb integer not null default 0,
  cel integer not null default 0,
  poprawa_kartkowki integer not null default 0,
  poprawa_klasowki integer not null default 0,
  poprawa_odpowiedzi integer not null default 0,
  np_jednorazowe integer not null default 0,
  np_tygodniowe integer not null default 0,
  wirtualne integer not null default 0,
  updated_at timestamptz not null default now()
);

-- 2) RLS: uczeń widzi tylko swój wiersz (statystyki w swoim panelu),
-- admin widzi i edytuje wszystkie (panel Punktów Aktywności).
alter table public.pa_zakupy enable row level security;

create policy "pa_zakupy_select_own_or_admin"
  on public.pa_zakupy for select
  to authenticated
  using (
    profil_id = auth.uid()
    or exists (select 1 from public.admins where id = auth.uid())
  );

create policy "pa_zakupy_insert_admins"
  on public.pa_zakupy for insert
  to authenticated
  with check (exists (select 1 from public.admins where id = auth.uid()));

create policy "pa_zakupy_update_admins"
  on public.pa_zakupy for update
  to authenticated
  using (exists (select 1 from public.admins where id = auth.uid()))
  with check (exists (select 1 from public.admins where id = auth.uid()));
