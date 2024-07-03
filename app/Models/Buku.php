<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../factories/BukuFactory.php';

class Buku
{
    private $conn;

    public function __construct()
    {
        $this->conn = require __DIR__ . '/../../config/database.php';
    }

    public function create($attributes = [])
    {
        $dataBuku = BukuFactory::create($attributes);

        $sql = "INSERT INTO buku (id_buku, id_kategori, judul, penulis, penerbit, tahun_terbit, jumlah_halaman, foto, sinopsis, ebook) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssssisss', $dataBuku['id_buku'], $dataBuku['id_kategori'], $dataBuku['judul'], $dataBuku['penulis'], $dataBuku['penerbit'], $dataBuku['tahun_terbit'], $dataBuku['jumlah_halaman'], $dataBuku['foto'], $dataBuku['sinopsis'], $dataBuku['ebook']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM buku";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM buku WHERE id_buku = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE buku SET id_kategori = ?, judul = ?, penulis = ?, penerbit = ?, tahun_terbit = ?, jumlah_halaman = ?, foto = ?, sinopsis = ?, ebook = ? WHERE id_buku = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssssisss', $data['id_kategori'], $data['judul'], $data['penulis'], $data['penerbit'], $data['tahun_terbit'], $data['jumlah_halaman'], $data['foto'], $data['sinopsis'], $data['ebook'], $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM buku WHERE id_buku = ?";
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
