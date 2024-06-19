<?php
$config = require __DIR__ . '/config.php';

try {
    $dsn = "mysql:host=" . $config['db']['host'] . ";port=" . $config['db']['port'] . ";dbname=" . $config['db']['database'];
    $pdo = new PDO($dsn, $config['db']['username'], $config['db']['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

return $pdo;
?>