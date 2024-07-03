<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../database/factories/KategoriFactory.php'; 

class Kategori
{
    private $conn;

    public function __construct()
    {
        $this->conn = require __DIR__ . '/../../config/database.php';
    }

    public function create($attributes = [])
    {
        $kategoriData = KategoriFactory::create($attributes);

        $sql = "INSERT INTO kategori (id_kategori, nama_kategori) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $kategoriData['id_kategori'], $kategoriData['nama_kategori']);

        if ($stmt->execute()) {
            echo "Kategori record created successfully.\n";
            return true;
        } else {
            echo "Error creating kategori record: " . $stmt->error . "\n";
            return false;
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM kategori";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id_kategori)
    {
        $sql = "SELECT * FROM kategori WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id_kategori);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id_kategori, $data)
    {
        $nama_kategori = $data['nama_kategori'] ?? 'Default Category Name';

        $sql = "UPDATE kategori SET nama_kategori = ? WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $nama_kategori, $id_kategori);

        if ($stmt->execute()) {
            echo "Kategori record updated successfully.\n";
            return true;
        } else {
            echo "Error updating kategori record: " . $stmt->error . "\n";
            return false;
        }
    }

    public function delete($id_kategori)
    {
        $sql = "DELETE FROM kategori WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id_kategori);

        if ($stmt->execute()) {
            echo "Kategori record deleted successfully.\n";
            return true;
        } else {
            echo "Error deleting kategori record: " . $stmt->error . "\n";
            return false;
        }
    }
}

?>
