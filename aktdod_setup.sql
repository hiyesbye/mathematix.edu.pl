-- Uruchom raz w Supabase SQL Editor przed publikacją nowych pól ocen.
-- Pola są niezależne od aktywnosc_1..10 i mają wagę 1 w aplikacji.
alter table public.semestr1
  add column if not exists aktdod1 integer,
  add column if not exists aktdod2 integer,
  add column if not exists aktdod3 integer,
  add column if not exists aktdod4 integer;
