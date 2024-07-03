<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../factories/PengembalianFactory.php';

class Pengembalian
{
    private $conn;

    public function __construct()
    {
        $this->conn = require __DIR__ . '/../../config/database.php';
    }

    public function create($attributes = [])
    {
        $pengembalianData = PengembalianFactory::create($attributes);

        $sql = "INSERT INTO pengembalian (id_pengembalian, id_pinjam, tanggal_pengembalian, denda) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iisi', $pengembalianData['id_pengembalian'], $pengembalianData['id_pinjam'], $pengembalianData['tanggal_pengembalian'], $pengembalianData['denda']);

        if ($stmt->execute()) {
            echo "Pengembalian record created successfully.\n";
            return true;
        } else {
            echo "Error creating pengembalian record: " . $stmt->error . "\n";
            return false;
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM pengembalian";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id_pengembalian)
    {
        $sql = "SELECT * FROM pengembalian WHERE id_pengembalian = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id_pengembalian);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id_pengembalian, $data)
    {
        $id_pinjam = $data['id_pinjam'] ?? '';
        $tanggal_pengembalian = $data['tanggal_pengembalian'] ?? date('Y-m-d H:i:s');
        $denda = $data['denda'] ?? 0;

        $sql = "UPDATE pengembalian SET id_pinjam = ?, tanggal_pengembalian = ?, denda = ? WHERE id_pengembalian = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('isii', $id_pinjam, $tanggal_pengembalian, $denda, $id_pengembalian);

        if ($stmt->execute()) {
            echo "Pengembalian record updated successfully.\n";
            return true;
        } else {
            echo "Error updating pengembalian record: " . $stmt->error . "\n";
            return false;
        }
    }

    public function delete($id_pengembalian)
    {
        $sql = "DELETE FROM pengembalian WHERE id_pengembalian = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id_pengembalian);

        if ($stmt->execute()) {
            echo "Pengembalian record deleted successfully.\n";
            return true;
        } else {
            echo "Error deleting pengembalian record: " . $stmt->error . "\n";
            return false;
        }
    }
}

?>
