<?php

require_once __DIR__ . '/../../config/database.php';

$conn = require __DIR__ . '/../../config/database.php';

$sql = "
CREATE TABLE IF NOT EXISTS user (
    id_user VARCHAR(10) NOT NULL PRIMARY KEY,
    id_akun VARCHAR(10) NOT NULL,
    nama VARCHAR(255) NOT NULL,
    alamat VARCHAR(255) DEFAULT NULL,
    no_telepon VARCHAR(14) DEFAULT NULL,
    FOREIGN KEY (id_akun) REFERENCES akun(id_akun) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

if (mysqli_query($conn, $sql)) {
    echo "Table 'user' created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
?>
