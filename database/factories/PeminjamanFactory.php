<?php

class PeminjamanFactory
{
    public static function create($attributes = [])
    {
        return [
            'id_user' => $attributes['id_user'] ?? '',
            'id_buku' => $attributes['id_buku'] ?? '',
            'tanggal_pinjam' => $attributes['tanggal_pinjam'] ?? null,
            'tanggal_kembali' => $attributes['tanggal_kembali'] ?? null,
        ];
    }
}

?>
