// Wspólny helper do własnych nazw kartkówek/prac kontrolnych, oddzielnych dla każdej klasy.
// Wymaga wczytanego supabase-config.js (zmienna `sb`) przed tym plikiem.

async function pobierzNazwyPrac(klasa) {
    if (!klasa) return {};
    const { data } = await sb.from('nazwy_prac').select('typ, numer, nazwa').eq('klasa', klasa);
    const mapa = {};
    (data || []).forEach(r => { if (r.nazwa) mapa[`${r.typ}|${r.numer}`] = r.nazwa; });
    return mapa;
}

function nazwaPracy(mapa, typ, numer, domyslnaBaza) {
    const custom = mapa && mapa[`${typ}|${numer}`];
    return custom || `${domyslnaBaza} ${numer}`;
}

// Skrócona etykieta do ciasnych kolumn dziennika (K1, K2, ... / PK1, PK2, ...).
// Pełna nazwa (własna lub domyślna) trafia do atrybutu title, więc pokazuje się po najechaniu kursorem.
function skrotTypu(typ) {
    return typ === 'kartkowka' ? 'K' : typ === 'praca_kontrolna' ? 'PK' : '';
}

function nazwaSkrocona(typ, numer) {
    return `${skrotTypu(typ)}${numer}`;
}
