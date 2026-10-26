// Własne oceny ucznia w oddzielnych tabelach; puste stopnie nie wchodzą do średnich.
async function pobierzOcenyWlasneUcznia(profilId, klasa) {
    if (!klasa) return [];
    const [def, wpisy] = await Promise.all([
        sb.from('oceny_wlasne').select('id,klasa,kategoria,nazwa,waga').eq('klasa', klasa),
        sb.from('oceny_wlasne_uczniow').select('ocena_id,stopien').eq('profil_id', profilId)
    ]);
    if (def.error || wpisy.error) throw new Error((def.error || wpisy.error).message);
    const mapa = Object.fromEntries((def.data || []).map(d => [d.id, d]));
    return (wpisy.data || []).filter(w => w.stopien != null && mapa[w.ocena_id])
        .map(w => ({ ...mapa[w.ocena_id], stopien: Number(w.stopien), waga: Number(mapa[w.ocena_id].waga) }));
}

function sumaOcenWlasnych(oceny) {
    let suma = 0, liczba = 0, sumaWazona = 0, sumaWag = 0;
    for (const o of oceny || []) {
        if (o.stopien == null) continue;
        const stopien = Number(o.stopien), waga = Number(o.waga);
        if (!Number.isFinite(stopien) || !Number.isFinite(waga) || waga <= 0) continue;
        suma += stopien; liczba++;
        sumaWazona += stopien * waga; sumaWag += waga;
    }
    return { suma, liczba, sumaWazona, sumaWag };
}
