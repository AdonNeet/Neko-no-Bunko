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

include('header.php'); ?>
<!-- <body>
    <section style="margin-bottom: 10vh">
        <div class="container-fluid">
            <div class="row mt-5">
            <div class="col-md-4 d-flex justify-content-center">
                <img src="red_queen.jpg" class="img-fluid" alt="Book Cover">
            </div>
            <div class="col-md-6">
                <h4>Victoria Aveyard</h4>
                <h2>Red Queen</h2>
                <p><strong>Stock :</strong> Tersedia</p>
                <h5>Deskripsi Buku</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Morbi blandit cursus risus at ultrices mi tempus. Fringilla ut morbi tincidunt augue interdum velit. Pretium nibh ipsum consequat nisl vel pretium lectus quam. Gravida neque convallis a cras semper auctor. Semper risus in hendrerit gravida rutrum quisque. Netus et malesuada fames ac turpis egestas maecenas. Malesuada proin libero nunc consequat interdum. Elementum eu facilisis sed odio morbi quis. Metus dictum at tempor commodo. Dictumst vestibulum rhoncus est pellentesque elit. Diam phasellus vestibulum lorem sed. Tortor consequat id porta nibh venenatis cras sed felis.</p>
                <div class="mt-4" >
                <button class="btn btn-primary">Pinjam</button>
                </div>
            </div>
            </div>
        </div>
    </section> -->
  
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html> -->

<?php


// Query untuk mengambil data buku
$id_buku = $_GET['id_buku']; // Ganti dengan ID buku yang ingin ditampilkan
$query = "SELECT * FROM buku WHERE id_buku = $id_buku";
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
                    <img src="/path/to/resource/img/<?php echo $book['foto']; ?>" class="img-fluid" alt="Book Cover">
                </div>
                <div class="col-md-6">
                    <h4><?php echo $book['penulis']; ?></h4>
                    <h2><?php echo $book['judul']; ?></h2>
                    <p><strong>Jumlah halaman :</strong> <?php echo $book['jumlah_halaman']; ?></p>
                    <h5>Deskripsi Buku</h5>
                    <p><?php echo $book['sinopsis']; ?></p>
                    <div class="mt-4">
                        <button class="btn btn-primary">Pinjam</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
