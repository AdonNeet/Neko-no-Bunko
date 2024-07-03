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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set('Asia/Jakarta');
    
    $id_pinjam = $_POST['id_pinjam'];
    $tgl_pinjam = $_POST['tanggal_pinjam']; // format: Y-m-d H:i:s
    $start_date = new DateTime($tgl_pinjam);
    $current_date = new DateTime();
    $interval = $current_date->diff($start_date);
    $hari = $interval->days;
    $denda = $hari * 3000;
    $current_date_str = $current_date->format('Y-m-d H:i:s');
    $query = "INSERT INTO pengembalian (id_pinjam, tanggal_pengembalian, denda) VALUES (?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "isi", $id_pinjam, $current_date_str, $denda);
        if (mysqli_stmt_execute($stmt)) {
            // echo "Data berhasil ditambahkan.";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $query = "UPDATE peminjaman SET tanggal_kembali = '$current_date_str' WHERE id_pinjam = '$id_pinjam'";
    $run = mysqli_query($conn, $query);

    header('Location: pinjam.php');
}
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
                  <input type="hidden" name="id_pinjam" value="<?php echo $row['id_pinjam']; ?>">
                  <input type="hidden" name="tanggal_pinjam" value="<?php echo $row['tanggal_pinjam']; ?>">
                  <th scope="row"><?php echo $nomer++; ?></th>
                  <td><?php echo $row['id_buku']; ?></td>
                  <td><?php echo $row['tanggal_pinjam']; ?></td>
                  <?php if($row['tanggal_kembali'] == NULL) { ?>
                    <td><button type="submit" class="btn btn-danger">Kembalikan</button></td>
                  <?php } ?>
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
