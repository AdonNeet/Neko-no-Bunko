<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../database/factories/PeminjamanFactory.php';

class Peminjaman
{
    private $conn;

    public function __construct()
    {
        $this->conn = require __DIR__ . '/../../config/database.php';
    }

    public function create($attributes = [])
    {
        $peminjamanData = PeminjamanFactory::create($attributes);

        $sql = "INSERT INTO peminjaman (id_user, id_buku, tanggal_pinjam, tanggal_kembali) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssss', $peminjamanData['id_user'], $peminjamanData['id_buku'], $peminjamanData['tanggal_pinjam'], $peminjamanData['tanggal_kembali']);

        if ($stmt->execute()) {
            echo "Peminjaman record created successfully.\n";
            return true;
        } else {
            echo "Error creating peminjaman record: " . $stmt->error . "\n";
            return false;
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM peminjaman";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id_pinjam)
    {
        $sql = "SELECT * FROM peminjaman WHERE id_pinjam = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id_pinjam);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id_pinjam, $data)
    {
        $sql = "UPDATE peminjaman SET id_user = ?, id_buku = ?, tanggal_pinjam = ?, tanggal_kembali = ? WHERE id_pinjam = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssi', $data['id_user'], $data['id_buku'], $data['tanggal_pinjam'], $data['tanggal_kembali'], $id_pinjam);

        if ($stmt->execute()) {
            echo "Peminjaman record updated successfully.\n";
            return true;
        } else {
            echo "Error updating peminjaman record: " . $stmt->error . "\n";
            return false;
        }
    }

    public function delete($id_pinjam)
    {
        $sql = "DELETE FROM peminjaman WHERE id_pinjam = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id_pinjam);

        if ($stmt->execute()) {
            echo "Peminjaman record deleted successfully.\n";
            return true;
        } else {
            echo "Error deleting peminjaman record: " . $stmt->error . "\n";
            return false;
        }
    }
}

?>
