-- Uruchom ten skrypt raz w Supabase: Dashboard -> SQL Editor -> New query -> wklej -> Run.
-- Tworzy tabelę do przechowywania własnych nazw kartkówek/prac kontrolnych, osobno dla każdej klasy.

-- 1) Tabela
create table if not exists public.nazwy_prac (
  id bigint generated always as identity primary key,
  klasa text not null,
  typ text not null check (typ in ('kartkowka', 'praca_kontrolna')),
  numer integer not null check (numer > 0),
  nazwa text,
  unique (klasa, typ, numer)
);

-- 2) Powiązanie z resztą danych.
-- semestr1 nie ma kolumny "klasa" (ma tylko profil_id -> profiles.id),
-- a profiles.klasa nie jest unikalne, więc twardy foreign key nie ma tu
-- zastosowania. Łączymy się po prostu po tekstowej wartości "klasa" -
-- dokładnie tak, jak filtruje kod w admin.html/profil.html. Indeks
-- przyspiesza to wyszukiwanie.
create index if not exists idx_nazwy_prac_klasa on public.nazwy_prac (klasa);

-- 3) RLS: każdy zalogowany (uczeń i admin) może odczytać nazwy - są
-- widoczne w profilu ucznia. Zapisywać/nadpisywać nazwy może tylko
-- admin (ten sam mechanizm co przy innych tabelach).
alter table public.nazwy_prac enable row level security;

create policy "nazwy_prac_select_authenticated"
  on public.nazwy_prac for select
  to authenticated
  using (true);

create policy "nazwy_prac_insert_admins"
  on public.nazwy_prac for insert
  to authenticated
  with check (exists (select 1 from public.admins where id = auth.uid()));

create policy "nazwy_prac_update_admins"
  on public.nazwy_prac for update
  to authenticated
  using (exists (select 1 from public.admins where id = auth.uid()))
  with check (exists (select 1 from public.admins where id = auth.uid()));
