// Wszystkie pozycje klasy, także te bez stopnia. Puste stopnie nie wchodzą do średnich.
async function pobierzOcenyWlasneUcznia(profilId, klasa) {
    if (!klasa) return [];
    const [def, wpisy] = await Promise.all([
        sb.from('oceny_wlasne').select('id,klasa,kategoria,nazwa,waga').eq('klasa', klasa),
        sb.from('oceny_wlasne_uczniow').select('ocena_id,stopien').eq('profil_id', profilId)
    ]);
    if (def.error || wpisy.error) throw new Error((def.error || wpisy.error).message);
    const stopnie = Object.fromEntries((wpisy.data || []).map(w => [w.ocena_id, w.stopien]));
    return (def.data || []).map(d => ({ ...d,
        stopien: stopnie[d.id] == null ? null : Number(stopnie[d.id]),
        waga: Number(d.waga)
    }));
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
