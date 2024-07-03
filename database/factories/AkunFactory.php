<?php

class AkunFactory
{
    public static function create($attributes = [])
    {
        $id_akun = $attributes['id_akun'] ?? self::generateIdAkun();
        $username = $attributes['username'] ?? 'default_username';
        $email = $attributes['email'] ?? 'default_email@example.com';
        $password = password_hash($attributes['password'] ?? 'default_password', PASSWORD_BCRYPT);
        $role = $attributes['role'] ?? 'user';

        return [
            'id_akun' => $id_akun,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role' => $role
        ];
    }

    private static function generateIdAkun()
    {
        return 'AK' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
    }
}

?>
