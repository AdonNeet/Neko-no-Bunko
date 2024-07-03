<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../database/factories/AdminFactory.php';

class Admin
{
    private $conn;

    public function __construct()
    {
        $this->conn = require __DIR__ . '/../../config/database.php';
    }

    public function create($attributes = [])
    {
        $adminData = AdminFactory::create($attributes);

        $sql = "INSERT INTO admin (id_admin, id_akun, name) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sss', $adminData['id_admin'], $adminData['id_akun'], $adminData['name']);

        if ($stmt->execute()) {
            echo "Admin record created successfully.\n";
            return true;
        } else {
            echo "Error creating admin record: " . $stmt->error . "\n";
            return false;
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM admin";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id_admin)
    {
        $sql = "SELECT * FROM admin WHERE id_admin = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id_admin);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id_admin, $data)
    {
        $id_akun = $data['id_akun'] ?? '';
        $name = $data['name'] ?? 'Default Name';

        $sql = "UPDATE admin SET id_akun = ?, name = ? WHERE id_admin = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sss', $id_akun, $name, $id_admin);

        if ($stmt->execute()) {
            echo "Admin record updated successfully.\n";
            return true;
        } else {
            echo "Error updating admin record: " . $stmt->error . "\n";
            return false;
        }
    }

    public function delete($id_admin)
    {
        $sql = "DELETE FROM admin WHERE id_admin = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id_admin);

        if ($stmt->execute()) {
            echo "Admin record deleted successfully.\n";
            return true;
        } else {
            echo "Error deleting admin record: " . $stmt->error . "\n";
            return false;
        }
    }
}

?>
