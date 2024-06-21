<?php

require_once __DIR__ . '/../../config/database.php';

$conn = require __DIR__ . '/../../config/database.php';

$sql = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB;
";

if (mysqli_query($conn, $sql)) {
    echo "Table 'users' created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
?>