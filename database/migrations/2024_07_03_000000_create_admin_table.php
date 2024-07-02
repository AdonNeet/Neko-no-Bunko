<?php

require_once __DIR__ . '/../../config/database.php';

$conn = require __DIR__ . '/../../config/database.php';

$sql = "
CREATE TABLE IF NOT EXISTS admin (
    id_admin VARCHAR(10) PRIMARY KEY,
    id_akun VARCHAR(10) NOT NULL,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_akun) REFERENCES akun(id_akun) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

if (mysqli_query($conn, $sql)) {
    echo "Table 'admin' created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
?>
