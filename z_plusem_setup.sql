-- Uruchom raz w Supabase SQL Editor przed publikacją zmiany strony.
-- Liczba punktów przypisanych w kolumnie „Z plusem” jest odejmowana
-- od salda „Pozostało”; „Łącznie” pozostaje bez zmian.
alter table public.pa_zakupy
  add column if not exists z_plusem integer not null default 0;
