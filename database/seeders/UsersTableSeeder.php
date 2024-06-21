// database/seeders/UsersTableSeeder.php
<?php

require_once __DIR__ . '/../factories/UserFactory.php';
require_once __DIR__ . '/../../config/database.php';

class UsersTableSeeder
{
    public function run()
    {
        $conn = require __DIR__ . '/../../config/database.php';

        $users = [
            ['username' => 'admin', 'password' => 'admin'],
            // Add more users as needed
        ];

        foreach ($users as $userData) {
            $user = UserFactory::create($userData);

            $stmt = $conn->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            $stmt->bind_param('ss', $user['username'], $user['password']);

            if ($stmt->execute()) {
                echo "Seeded user: {$user['username']}\n";
            } else {
                echo "Error seeding user: {$user['username']}. Error: " . $stmt->error . "\n";
            }
        }

        $stmt->close();
        mysqli_close($conn);
    }
}
?>