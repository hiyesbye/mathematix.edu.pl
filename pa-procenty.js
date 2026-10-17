// Procent zdobyty z pracy jest zaokrąglany tak samo jak w dzienniku punktów.
function paProcent(pkt, maks) {
    if (pkt == null || maks == null || maks <= 0) return null;
    const wynik = Math.round(pkt / maks * 100);
    return wynik >= 0 && wynik <= 100 ? wynik : null;
}

function paOcenaZProcentu(procent) {
    if (procent == null) return null;
    if (procent < 30) return 1;
    if (procent < 50) return 2;
    if (procent < 70) return 3;
    if (procent < 87) return 4;
    if (procent < 97) return 5;
    return 6;
}

function paOcenaPoZakupie(pkt, maks, kupione) {
    const procent = paProcent(pkt, maks);
    return procent == null ? null : paOcenaZProcentu(Math.min(100, procent + (kupione || 0)));
}

function paCelDlaPlusa(procent) {
    if (procent == null) return null;
    if (procent >= 20 && procent < 30) return 30;
    if (procent >= 40 && procent < 50) return 50;
    if (procent >= 60 && procent < 70) return 70;
    if (procent >= 80 && procent < 87) return 87;
    if (procent >= 91 && procent < 97) return 97;
    return null;
}

function paMapaBonusow(wiersze) {
    const mapa = {};
    (wiersze || []).forEach(w => {
        if (!mapa[w.profil_id]) mapa[w.profil_id] = {};
        mapa[w.profil_id][`${w.typ}_${w.numer}`] = w.punkty_procentowe;
    });
    return mapa;
}
