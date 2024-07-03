<?php
$migrationOrder = [
    '2024_06_19_000000_create_akun_table.php',
    '2024_07_03_000000_create_admin_table.php',
    '2024_07_03_000000_create_user_table.php',
    '2024_07_03_000000_create_kategori_table.php',
    '2024_07_03_000000_create_buku_table.php',
    '2024_07_03_000000_create_peminjaman_table.php',
    '2024_07_03_000000_create_pengembalian_table.php',
];

foreach ($migrationOrder as $filename) {
    $filepath = __DIR__ . "/migrations/$filename";
    if (file_exists($filepath)) {
        include $filepath;
    } else {
        echo "File migrasi '$filename' tidak ditemukan.\n";
    }
}
?>