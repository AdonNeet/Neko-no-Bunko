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
                $this->showAlert('Register berhasil! Selamat datang, ' . $data['nama'] . '!', '/../user/profile.php');
            } else {
                $this->showAlert('Registrasi gagal', '/auth/');
            }
        } else {
            $this->showAlert("Registrasi gagal", '/auth/');
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
                $this->showAlert('Login berhasil! Selamat datang, ' . $akun['username'] . '!', '/../user/profile.php');
            } else {
                $_SESSION['role'] = $akun['role'];
                $this->showAlert('Login berhasil! Selamat datang, ' . $akun['username'] . '!', '/../admin/admin_index.php');
            }
        } else {
            $this->showAlert("Username/email or password salah.", '/auth/');
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        echo "Logout successful!";
    }

    private function showAlert($message, $redirectUrl) {
        // Menampilkan alert menggunakan JavaScript dan kemudian mengalihkan halaman menggunakan meta tag
        echo '<script type="text/javascript">';
        echo 'alert("' . $message . '");';
        echo 'window.location.href = "' . $redirectUrl . '";';
        echo '</script>';
        exit;
    }
}
?>
