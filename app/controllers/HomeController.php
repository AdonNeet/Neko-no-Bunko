<?php
class HomeController
{
    public function index()
    {
        require_once __DIR__ . '/../views/home/index.php';
    }

    public function img()
    {
        require_once __DIR__ . '/../views/home/dumy.jpg';
    }

    public function search() 
    {
        require_once __DIR__ . '/../views/home/search.php';
    }

    public function searchStyle()
    {
        require_once __DIR__ . '/../views/home/style.css';
    }
}

?>