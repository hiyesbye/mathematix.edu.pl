-- Uruchom ten skrypt raz w Supabase: Dashboard -> SQL Editor -> New query -> wklej -> Run.
-- Dokłada 5 kolejnych pól Aktywności (aktywnosc_6..aktywnosc_10) do semestr1,
-- żeby było gdzie automatycznie wpisywać oceny 5/6 przyznawane przez zakupy
-- "bdb"/"cel" w panelu Punktów Aktywności, bez nadpisywania ręcznie
-- wystawionych ocen w polach 1-5.

alter table public.semestr1
  add column if not exists aktywnosc_6  integer,
  add column if not exists aktywnosc_7  integer,
  add column if not exists aktywnosc_8  integer,
  add column if not exists aktywnosc_9  integer,
  add column if not exists aktywnosc_10 integer;
