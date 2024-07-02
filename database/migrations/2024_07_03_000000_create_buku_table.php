// migrations/create_user_table.php
<?php

require_once __DIR__ . '/../../config/database.php';

$conn = require __DIR__ . '/../../config/database.php';

$sql = "
CREATE TABLE IF NOT EXISTS buku (
    id_buku varchar(10) NOT NULL,
    id_kategori varchar(10) NOT NULL,
    judul varchar(255) NOT NULL,
    penulis varchar(255) NOT NULL,
    penerbit varchar(255) NOT NULL,
    tahun_terbit year(4) NOT NULL,
    jumlah_halaman int(10) UNSIGNED DEFAULT NULL,
    foto varchar(255) DEFAULT NULL,
    sinopsis text DEFAULT NULL,
    ebook varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

if (mysqli_query($conn, $sql)) {
    echo "Table 'buku' created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
?>
