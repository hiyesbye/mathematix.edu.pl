-- Krok 1 z 4: tabele. Wklej cały ten krótki plik do Supabase SQL Editor.
create table if not exists public.oceny_wlasne (
  id uuid primary key default gen_random_uuid(),
  klasa text not null check (length(btrim(klasa)) > 0),
  kategoria text not null check (length(btrim(kategoria)) > 0),
  nazwa text not null check (length(btrim(nazwa)) > 0),
  waga numeric(6,2) not null check (waga > 0 and waga <= 100),
  created_at timestamptz not null default now()
);
create index if not exists oceny_wlasne_klasa_idx on public.oceny_wlasne (klasa);

create table if not exists public.oceny_wlasne_uczniow (
  ocena_id uuid not null references public.oceny_wlasne(id) on delete cascade,
  profil_id uuid not null references public.profiles(id) on delete cascade,
  stopien smallint check (stopien between 1 and 6),
  primary key (ocena_id, profil_id)
);
create index if not exists oceny_wlasne_uczniow_profil_idx
  on public.oceny_wlasne_uczniow (profil_id);
