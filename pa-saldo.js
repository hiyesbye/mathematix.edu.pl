// Wspólna logika Punktów Aktywności (PA) — cennik sklepiku i wzór na saldo.
// Używane przez: punkty-aktywnosci-admin.html, sklepik.html, profil.html,
// statystyki-punktow.html.
//
// Saldo = Overall (semestr1.punkty_aktywnosci)
//         - 5*bdb - 10*cel
//         - 2*poprawa_kartkowki - 4*poprawa_klasowki - 5*poprawa_odpowiedzi
//         - 10*np_jednorazowe - 30*np_tygodniowe
//         + wirtualne

const PA_CENNIK = {
    bdb: 5,
    cel: 10,
    poprawa_kartkowki: 2,
    poprawa_klasowki: 4,
    poprawa_odpowiedzi: 5,
    np_jednorazowe: 10,
    np_tygodniowe: 30,
};

const PA_ETYKIETY = {
    bdb: 'Ocena bdb (aktywność)',
    cel: 'Ocena celująca (aktywność)',
    poprawa_kartkowki: 'Poprawa kartkówki',
    poprawa_klasowki: 'Poprawa pracy kontrolnej',
    poprawa_odpowiedzi: 'Poprawa odpowiedzi',
    np_jednorazowe: 'Nieprzygotowanie jednorazowe',
    np_tygodniowe: 'Nieprzygotowanie tygodniowe',
};

function paWydane(zakupy) {
    const z = zakupy || {};
    let suma = 0;
    for (const klucz in PA_CENNIK) suma += (z[klucz] || 0) * PA_CENNIK[klucz];
    return suma;
}

function paSaldo(overall, zakupy) {
    const o = overall || 0;
    const wirtualne = (zakupy && zakupy.wirtualne) || 0;
    return o - paWydane(zakupy) + wirtualne;
}

// Liczba pól Aktywności w semestr1 (aktywnosc_1 .. aktywnosc_N).
const PA_AKTYWNOSC_LICZBA = 10;
const PA_OCENA_ZA_ZAKUP = { bdb: 5, cel: 6 };

// Porównuje stare i nowe wartości aktywnosc_1..N (tablice, index 0 = pole 1)
// i zwraca, ile piątek/szóstek zniknęło (zostało usunięte lub zmienione na coś innego).
// Używane, gdy nauczyciel ręcznie kasuje/zmienia ocenę w Dzienniku ocen — żeby
// odpowiednio cofnąć licznik "kupionych" ocen w panelu Punktów Aktywności.
function paLiczUtraconeOceny(stare, nowe) {
    let utracone5 = 0, utracone6 = 0;
    const n = Math.max(stare.length, nowe.length);
    for (let i = 0; i < n; i++) {
        const s = stare[i], w = nowe[i];
        if (s === 5 && w !== 5) utracone5++;
        if (s === 6 && w !== 6) utracone6++;
    }
    return { utracone5, utracone6 };
}

// Odejmuje od pa_zakupy.bdb/cel tyle, ile piątek/szóstek zniknęło z Aktywności
// (nigdy poniżej 0). Cicho nic nie robi, jeśli uczeń nie ma jeszcze wiersza zakupów.
async function paCofnijZakupyPoUtraconychOcenach(sb, profilId, utracone5, utracone6) {
    if (utracone5 <= 0 && utracone6 <= 0) return;
    const { data: zak } = await sb.from('pa_zakupy').select('bdb,cel').eq('profil_id', profilId).single();
    if (!zak) return;
    const nowyBdb = Math.max(0, (zak.bdb || 0) - utracone5);
    const nowyCel = Math.max(0, (zak.cel || 0) - utracone6);
    if (nowyBdb === zak.bdb && nowyCel === zak.cel) return;
    await sb.from('pa_zakupy').upsert({ profil_id: profilId, bdb: nowyBdb, cel: nowyCel }, { onConflict: 'profil_id' });
}
