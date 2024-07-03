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

$id_user = $user['id_user'];
$query = "SELECT * FROM peminjaman WHERE id_user = '$id_user'";

$result = mysqli_query($conn, $query);



?>

<?php include('header.php'); ?>
<body>
  <div class="container-fluid">
    <div class="row mt-5">
      <div class="col-md-3">
        <div class="list-group">
          <a href="profile.php" class="list-group-item list-group-item-action">Akun Saya</a>
          <a href="#" class="list-group-item list-group-item-action">Pinjaman Saya</a>
          <a href="/../logout.php" class="list-group-item list-group-item-action">Keluar</a>
        </div>
      </div>
      <div class="col-md-9">
        <h3>Daftar Pinjaman</h3>
        <?php if (mysqli_num_rows($result) > 0): ?>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Buku yang dipinjam</th>
                <th scope="col">Tanggal pinjam</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php $nomer = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                <form method="POST" action="pinjam.php">
                  <th scope="row"><?php echo $nomer++; ?></th>
                  <td><?php echo $row['id_buku']; ?></td>
                  <td><?php echo $row['tanggal_pinjam']; ?></td>
                  <td><button type="submit" class="btn btn-danger">Kembalikan</button></td>
                </form>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p>Belum ada data peminjaman.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
