<?php

require_once __DIR__ . '/../../config/database.php';

$conn = require __DIR__ . '/../../config/database.php';

$sql = "
CREATE TABLE IF NOT EXISTS akun (
    id_akun VARCHAR(10) PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

if (mysqli_query($conn, $sql)) {
    echo "Table 'akun' created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
?>
