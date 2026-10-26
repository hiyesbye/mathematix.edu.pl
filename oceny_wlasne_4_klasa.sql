-- Krok 4 z 4: wymuszanie zgodności klasy wpisu i definicji.
create or replace function public.oceny_wlasne_sprawdz_klase()
returns trigger language plpgsql security definer
set search_path = public, pg_temp as $$
declare v_klasa text;
begin
  select klasa into v_klasa from public.oceny_wlasne where id = new.ocena_id;
  if v_klasa is null or not exists (
    select 1 from public.profiles where id = new.profil_id and klasa = v_klasa
  ) then
    raise exception 'Uczeń nie należy do klasy przypisanej do tej oceny';
  end if;
  return new;
end;
$$;
drop trigger if exists oceny_wlasne_sprawdz_klase on public.oceny_wlasne_uczniow;
create trigger oceny_wlasne_sprawdz_klase
before insert or update on public.oceny_wlasne_uczniow
for each row execute function public.oceny_wlasne_sprawdz_klase();

create or replace function public.oceny_wlasne_sprawdz_zmiane_klasy()
returns trigger language plpgsql security definer
set search_path = public, pg_temp as $$
begin
  if new.klasa is distinct from old.klasa and exists (
    select 1 from public.oceny_wlasne_uczniow
    where ocena_id = old.id and stopien is not null
  ) then
    raise exception 'Nie można zmienić klasy oceny z wystawionymi stopniami';
  end if;
  return new;
end;
$$;
drop trigger if exists oceny_wlasne_sprawdz_zmiane_klasy on public.oceny_wlasne;
create trigger oceny_wlasne_sprawdz_zmiane_klasy
before update on public.oceny_wlasne
for each row execute function public.oceny_wlasne_sprawdz_zmiane_klasy();
