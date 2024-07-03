<?php

require_once __DIR__ . '/../models/Akun.php';
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private $akun;
    private $user;

    public function __construct()
    {
        session_start(); // Start the session
        $this->akun = new Akun();
        $this->user = new User();
    }

    public function register($data)
    {
        // Create account
        $akunData = [
            'username' => $data['username'],
            'email' => $data['email'],
            'no_hp' => $data['no_telepon'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => 'user'
        ];

        if ($this->akun->create($akunData)) {
            $akun_id = $this->akun->getLastInsertedId();
            $userData = [
                'id_akun' => $akun_id,
                'nama' => $data['nama'],
                'alamat' => '-',
                'no_telepon' => $data['no_telepon']
            ];

            if ($this->user->create($userData)) {
                $_SESSION['user_id'] = $akun_id; 
                echo "Registration successful!";
                header('Location: /../user/profile.php');
            } else {
                echo "User creation failed.";
            }
        } else {
            echo "Account creation failed.";
        }
    }

    public function login($data)
    {
        $username_or_email = $data['username_or_email'];
        $password = $data['password'];

        $akun = $this->akun->findByUsernameOrEmail($username_or_email);

        if ($akun && password_verify($password, $akun['password'])) {
            if ($akun['role'] == 'user') {
                $_SESSION['user_id'] = $akun['id_akun'];
                echo "Login successful!";
                header('Location: /../user/profile.php');
            } else {
                $_SESSION['user_id'] = $akun['id_akun'];
                echo "Login successful!";
                header('Location: /../admin/admin_index.php');
            }
        } else {
            echo "Invalid username/email or password.";
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        echo "Logout successful!";
    }
}
?>
