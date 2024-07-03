<?php

class PengembalianFactory
{
    public static function create($attributes = [])
    {
        $id_pinjam = $attributes['id_pinjam'] ?? '';
        $tanggal_pengembalian = $attributes['tanggal_pengembalian'] ?? date('Y-m-d H:i:s');
        $denda = $attributes['denda'] ?? 0;

        return [
            'id_pinjam' => $id_pinjam,
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'denda' => $denda
        ];
    }

    private static function generateIdPengembalian()
    {
        return mt_rand(1, 1000000);
    }
}

?>
