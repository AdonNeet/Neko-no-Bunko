<?php

class AdminFactory
{
    public static function create($attributes = [])
    {
        $id_admin = $attributes['id_admin'] ?? self::generateIdAdmin();
        $id_akun = $attributes['id_akun'] ?? '';
        $name = $attributes['name'] ?? 'Default Name';

        return [
            'id_admin' => $id_admin,
            'id_akun' => $id_akun,
            'name' => $name
        ];
    }

    private static function generateIdAdmin()
    {
        return 'ADM' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
    }
}

?>
