<?php

class KategoriFactory
{
    public static function create($attributes = [])
    {
        $id_kategori = $attributes['id_kategori'] ?? self::generateIdKategori();
        $nama_kategori = $attributes['nama_kategori'] ?? 'Default Category Name';

        return [
            'id_kategori' => $id_kategori,
            'nama_kategori' => $nama_kategori,
        ];
    }

    private static function generateIdKategori()
    {
        return 'KTG' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
    }
}

?>
