<?php

class UserFactory
{
    public static function create($attributes = [])
    {
        $id_user = $attributes['id_user'] ?? self::generateIdUser();
        $id_akun = $attributes['id_akun'] ?? '';
        $nama = $attributes['nama'] ?? 'Default Name';
        $alamat = $attributes['alamat'] ?? null;
        $no_telepon = $attributes['no_telepon'] ?? null;

        return [
            'id_user' => $id_user,
            'id_akun' => $id_akun,
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telepon' => $no_telepon
        ];
    }

    private static function generateIdUser()
    {
        return 'USR' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
    }
}

?>
