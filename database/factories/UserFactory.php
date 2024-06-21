<?php

class UserFactory
{
    public static function create($attributes = [])
    {
        $username = $attributes['username'] ?? 'default_username';
        $password = password_hash($attributes['password'] ?? 'default_password', PASSWORD_BCRYPT);

        return [
            'username' => $username,
            'password' => $password
        ];
    }
}

?>