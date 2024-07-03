<?php

class BukuFactory
{
    public static function create($attributes = [])
    {
        $id_buku = $attributes['id_buku'] ?? self::generateIdBuku();
        $id_kategori = $attributes['id_kategori'] ?? '';
        $judul = $attributes['judul'] ?? 'Default Judul';
        $penulis = $attributes['penulis'] ?? 'Default Penulis';
        $penerbit = $attributes['penerbit'] ?? 'Default Penerbit';
        $tahun_terbit = $attributes['tahun_terbit'] ?? date('Y');
        $jumlah_halaman = $attributes['jumlah_halaman'] ?? null;
        $foto = $attributes['foto'] ?? null;
        $sinopsis = $attributes['sinopsis'] ?? null;
        $ebook = $attributes['ebook'] ?? null;

        return [
            'id_buku' => $id_buku,
            'id_kategori' => $id_kategori,
            'judul' => $judul,
            'penulis' => $penulis,
            'penerbit' => $penerbit,
            'tahun_terbit' => $tahun_terbit,
            'jumlah_halaman' => $jumlah_halaman,
            'foto' => $foto,
            'sinopsis' => $sinopsis,
            'ebook' => $ebook
        ];
    }

    private static function generateIdBuku()
    {
        return 'BK' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
    }
}

?>
