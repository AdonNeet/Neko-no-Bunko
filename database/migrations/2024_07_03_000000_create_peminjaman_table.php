<?php

require_once __DIR__ . '/../../config/database.php';

$conn = require __DIR__ . '/../../config/database.php';

$sql = "
CREATE TABLE IF NOT EXISTS peminjaman (
    id_pinjam int(10) UNSIGNED NOT NULL,
    id_user varchar(10) NOT NULL,
    id_buku varchar(10) NOT NULL,
    tanggal_pinjam datetime DEFAULT NULL,
    tanggal_kembali datetime DEFAULT NULL,
    PRIMARY KEY (id_pinjam),
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_buku) REFERENCES buku(id_buku) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

if (mysqli_query($conn, $sql)) {
    echo "Table 'kategori' created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
?>
