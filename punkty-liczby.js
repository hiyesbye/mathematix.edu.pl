// Punkty z pracy mogą mieć część ułamkową. Akceptujemy przecinek i kropkę.
function parsujPunkty(tekst) {
    const wartosc = String(tekst ?? '').trim();
    if (!wartosc) return null;
    if (!/^\d+(?:[,.]\d{1,2})?$/.test(wartosc)) {
        throw new Error('Wpisz nieujemną liczbę punktów (maksymalnie dwa miejsca po przecinku).');
    }
    const liczba = Number(wartosc.replace(',', '.'));
    if (!Number.isFinite(liczba) || liczba > 99999999.99) {
        throw new Error('Liczba punktów jest poza dozwolonym zakresem.');
    }
    return liczba;
}

function podgladPunktow(tekst) {
    try { return parsujPunkty(tekst); } catch (_) { return null; }
}
