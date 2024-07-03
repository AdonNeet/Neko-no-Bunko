<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../database/factories/AkunFactory.php'; 

class Akun
{
    private $conn;

    public function __construct()
    {
        $this->conn = require __DIR__ . '/../../config/database.php';
    }

    public function create($attributes = [])
    {
        $akunData = AkunFactory::create($attributes);

        $sql = "INSERT INTO akun (id_akun, username, email, password, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssss', $akunData['id_akun'], $akunData['username'], $akunData['email'], $akunData['password'], $akunData['role']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM akun";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM akun WHERE id_akun = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE akun SET username = ?, email = ?, password = ?, role = ? WHERE id_akun = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssss', $data['username'], $data['email'], $data['password'], $data['role'], $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM akun WHERE id_akun = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findByUsernameOrEmail($username_or_email)
    {
        $sql = "SELECT * FROM akun WHERE username = ? OR email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $username_or_email, $username_or_email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getLastInsertedId()
    {
        $sql = "SELECT id_akun FROM akun ORDER BY updated_at DESC LIMIT 1";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['id_akun'];
        } else {
            return null; // Return null or handle error as per your application's logic
        }
    }


}

?>
