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
if (!isset($_SESSION["user_id"])) {
    header("Location: books.php");
    exit;
}

// Mengambil id_akun dari session
$id_akun = $_SESSION["user_id"];

// Membuat instance dari model Akun dan User
$akunModel = new Akun();
$userModel = new User();

$akun = $akunModel->find($id_akun);
$user = $userModel->findByAkunId($id_akun);

include('header.php'); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['pinjam'])){
        $id_user = $user['id_user'];
        $id_buku = $_POST['id_buku'];
        $current_date = (new DateTime())->format('Y-m-d H:i:s');
    
        $query = "INSERT INTO peminjaman (id_user, id_buku, tanggal_pinjam) VALUES ('$id_user', '$id_buku', '$current_date')";
        if (mysqli_query($conn, $query)) {
            echo "Data berhasil ditambahkan.";
            header("Location: book_detail.php?id_buku=$id_buku");
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}

// Query untuk mengambil data buku
$id_buku = $_GET['id_buku']; // Ganti dengan ID buku yang ingin ditampilkan
$query = "SELECT * FROM buku WHERE id_buku = '$id_buku'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $book = mysqli_fetch_assoc($result);
} else {
    echo "Buku tidak ditemukan.";
    exit;
}
?>
<body>
    <section style="margin-bottom: 10vh">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-4 d-flex justify-content-center">
                    <img src="/../resource/img/<?= $book['foto']; ?>" class="img-fluid" alt="Book Cover">
                </div>
                <div class="col-md-6">
                    <form action="book_detail.php" method="post">
                    <input type="hidden" name="id_buku" value="<?= $id_buku;?>">
                    <h4><?php echo $book['penulis']; ?></h4>
                    <h2><?php echo $book['judul']; ?></h2>
                    <p><strong>Jumlah halaman :</strong> <?php echo $book['jumlah_halaman']; ?></p>
                    <h5>Deskripsi Buku</h5>
                    <p><?php echo $book['sinopsis']; ?></p>
                    <div class="mt-4">
                        <button class="btn btn-primary" name="pinjam" onclick="return confirmSubmit();">Pinjam</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
