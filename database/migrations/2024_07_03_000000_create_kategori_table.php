// migrations/create_user_table.php
<?php

require_once __DIR__ . '/../../config/database.php';

$conn = require __DIR__ . '/../../config/database.php';

$sql = "
CREATE TABLE IF NOT EXISTS kategori (
    id_kategori varchar(10) NOT NULL,
    nama_kategori varchar(45) NOT NULL,
    PRIMARY KEY (id_kategori)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

if (mysqli_query($conn, $sql)) {
    echo "Table 'kategori' created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
?>
