<?php
$config = require __DIR__ . '/config.php';

$host = $config['db']['host'];
$port = $config['db']['port'];
$database = $config['db']['database'];
$username = $config['db']['username'];
$password = $config['db']['password'];

$conn = mysqli_connect($host, $username, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

return $conn;
?>