<?php
require_once __DIR__ . '/../../config/auth.php';

class UserController
{
    public function profile()
    {
        if (!checkAuth()) {
            header('Location: /login');
            exit();
        }

        $user = getUser();

        require_once __DIR__ . '/../views/user/profile.php';
    }

    public function index()
    {
        require_once __DIR__ . '/../views/user/pinjam.php';
    }
}
?>