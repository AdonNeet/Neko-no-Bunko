<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../database/factories/AkunFactory.php'; 

class Akun
{
    private $conn;

    public function __construct()
    {
        $this->conn = require __DIR__ . '/../config/database.php';
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
}

?>
