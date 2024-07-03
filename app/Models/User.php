<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../database/factories/UserFactory.php';

class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = require __DIR__ . '/../../config/database.php';
    }

    public function create($attributes = [])
    {
        $userData = UserFactory::create($attributes);

        $sql = "INSERT INTO user (id_user, id_akun, nama, alamat, no_telepon) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssss', $userData['id_user'],  $userData['id_akun'],  $userData['nama'],  $userData['alamat'],  $userData['no_telepon']);

        if ($stmt->execute()) {
            echo "User record created successfully.\n";
            return true;
        } else {
            echo "Error creating user record: " . $stmt->error . "\n";
            return false;
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM user";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id_user)
    {
        $sql = "SELECT * FROM user WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id_user, $data)
    {
        $id_akun = $data['id_akun'] ?? '';
        $nama = $data['nama'] ?? 'Default Name';
        $alamat = $data['alamat'] ?? null;
        $no_telepon = $data['no_telepon'] ?? null;

        $sql = "UPDATE user SET id_akun = ?, nama = ?, alamat = ?, no_telepon = ? WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssss', $id_akun, $nama, $alamat, $no_telepon, $id_user);

        if ($stmt->execute()) {
            echo "User record updated successfully.\n";
            return true;
        } else {
            echo "Error updating user record: " . $stmt->error . "\n";
            return false;
        }
    }

    public function delete($id_user)
    {
        $sql = "DELETE FROM user WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id_user);

        if ($stmt->execute()) {
            echo "User record deleted successfully.\n";
            return true;
        } else {
            echo "Error deleting user record: " . $stmt->error . "\n";
            return false;
        }
    }
}

?>
