<?php
require_once __DIR__ . '/../../config/auth.php';

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (login($username, $password)) {
                header('Location: /user/profile');
                exit();
            } else {
                echo 'Invalid username or password';
            }
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function logout()
    {
        logout();
        header('Location: /');
        exit();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password === $confirmPassword) {
                if (register($username, $password)) {
                    header('Location: /login');
                    exit();
                } else {
                    echo 'Registration failed. Username might already be taken.';
                }
            } else {
                echo 'Passwords do not match.';
            }
        }

        require_once __DIR__ . '/../views/auth/register.php';
    }
}
?>