<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../app/models/Akun.php';
require_once __DIR__ . '/../../app/models/User.php';

session_start();

// jika belum login maka diarahkan ke halaman login
if (!isset($_SESSION["user_id"])) {
    header("Location: /../auth");
    exit;
}

// Mengambil id_akun dari session
$id_akun = $_SESSION["user_id"];

// Membuat instance dari model Akun dan User
$akunModel = new Akun();
$userModel = new User();

// Mengambil data akun dan user berdasarkan id_akun
$akun = $akunModel->find($id_akun);
$user = $userModel->findByAkunId($id_akun);

// Memproses form jika dikirimkan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $no_telepon = $_POST['no_telepon'] ?? '';
    $alamat = $_POST['alamat'] ?? '';

    // Mengupdate data akun
    $akunUpdate = $akunModel->update($id_akun, ['username' => $akun['username'], 'email' => $email, 'password' => $akun['password'], 'role' => $akun['role']]);

    // Mengupdate data user
    $userUpdate = $userModel->update($user['id_user'], ['id_akun' => $id_akun, 'nama' => $nama, 'no_telepon' => $no_telepon, 'alamat' => $alamat]);

    if ($akunUpdate && $userUpdate) {
        echo "Data berhasil diperbarui!";
        // Refresh halaman untuk menampilkan data terbaru
        header("Location: profile.php");
        exit;
    } else {
        echo "Gagal memperbarui data.";
    }
}

?>


<?php include('header.php'); ?>
<body>
  <div class="container-fluid">
    <div class="row mt-5">
      <div class="col-md-3">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action">Akun Saya</a>
          <a href="pinjam.php" class="list-group-item list-group-item-action">Pinjaman Saya</a>
          <a href="/../logout.php" class="list-group-item list-group-item-action">Keluar</a>
        </div>
      </div>
      <div class="col-md-9">
        <h3>Akun Saya</h3>
        <div class="d-flex justify-content-center align-items-center">
            <div class="text-center">
            <form method="POST" action="profile.php">
              <table class="table table-borderless">
                  <tbody>
                      <tr>
                          <td>
                              <div style="text-align: right;">
                              <label for="namaLengkap">Nama Lengkap:</label>
                            </div>
                          </td>
                          <td>
                              <div style="width: 35vh;">
                                  <input type="text" class="form-control" id="namaLengkap" name="nama" placeholder="Nama Lengkap" value="<?= $user['nama'] ?? '' ?>">
                                </div>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div style="text-align: right;">
                                  <label for="email">Email:</label>
                                </div>
                          </td>
                          <td>
                              <div style="width: 35vh;">
                                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $akun['email'] ?? '' ?>">
                                </div>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div style="text-align: right;">
                                  <label for="noTelpon">No. Telpon:</label>
                            </div>
                          </td>
                          <td>
                              <div style="width: 35vh;">
                                  <input type="tel" class="form-control" id="noTelpon" name="no_telepon" placeholder="No. Telpon" value="<?= $user['no_telepon'] ?? '' ?>">
                                </div>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div style="text-align: right;">
                                  <label for="alamat">Alamat:</label>
                            </div>
                          </td>
                          <td>
                              <div style="width: 35vh;">
                                  <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat"><?= $user['alamat'] ?? '' ?></textarea>
                                </div>
                          </td>
                      </tr>
                      <tr>
                          <td>    
                               <!-- kosongan -->
                          </td>
                          <td>
                              <div style="width: 35vh; text-align: right;">
                                  <button type="submit" class="btn btn-primary">Simpan</button> 
                                </div>
                          </td>
                      </tr>
                  </tbody>
              </table>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
