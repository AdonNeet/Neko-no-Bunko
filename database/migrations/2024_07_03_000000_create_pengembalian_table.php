<?php

require_once __DIR__ . '/../../config/database.php';

$conn = require __DIR__ . '/../../config/database.php';

$sql = "
CREATE TABLE IF NOT EXISTS pengembalian (
    `id_pengembalian` int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_pinjam` int(10) UNSIGNED NOT NULL,
    `tanggal_pengembalian` datetime DEFAULT NULL,
    `denda` int(11) DEFAULT NULL,
    FOREIGN KEY (id_pinjam) REFERENCES peminjaman(id_pinjam) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

if (mysqli_query($conn, $sql)) {
    echo "Table 'pengembalian' created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
?>
