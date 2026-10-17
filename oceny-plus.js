// Oznaczenie (+) jest wyłącznie wizualne; w semestr1 zostaje ocena całkowita.
function ocenaMaPlus(pole, ocena, punkty) {
    if (ocena === null || ocena === undefined || ocena === '' || !punkty) return false;
    const kart = /^kartkowka_([1-8])$/.exec(pole);
    const klas = /^praca_kontrolna_([1-4])$/.exec(pole);
    if (!kart && !klas) return false;
    const numer = (kart || klas)[1];
    const zdobyte = punkty[`${kart ? 'kartp' : 'klasp'}${numer}`];
    const maksimum = punkty[`${kart ? 'kartmax' : 'klasmax'}${numer}`];
    if (zdobyte == null || maksimum == null || maksimum <= 0) return false;
    const procent = Math.round(zdobyte / maksimum * 100);
    const progi = [
        [20, 30, 1], [40, 50, 2], [60, 70, 3],
        [80, 87, 4], [91, 97, 5]
    ];
    return progi.some(([od, doProgu, stopien]) => procent >= od && procent < doProgu && Number(ocena) === stopien);
}

function poleOcenyZPlusem(id, profilId, pole, ocena, punkty, kolor) {
    const wartosc = ocena ?? '';
    const plus = ocenaMaPlus(pole, wartosc, punkty);
    return `<span class="dz-ocena-wrap"><input class="dz-input ${kolor}" type="number" id="${id}" data-profil-id="${profilId}" step="1" value="${wartosc}" placeholder="—" oninput="odswiezPlusDziennika(this, '${pole}')"><span class="dz-plus" ${plus ? '' : 'hidden'}>(+)</span></span>`;
}

function odswiezPlusDziennika(input, pole) {
    const punkty = window.dzPunktyMap?.[input.dataset.profilId];
    const znacznik = input.nextElementSibling;
    if (znacznik) znacznik.hidden = !ocenaMaPlus(pole, input.value, punkty);
}
