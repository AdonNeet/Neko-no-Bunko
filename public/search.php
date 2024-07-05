<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/models/Akun.php';
require_once __DIR__ . '/../app/models/User.php';

session_start();

// jika belum login maka diarahkan ke halaman login
if (!isset($_SESSION["user_id"])) {
    header("Location: /../auth/");
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Pinjam'])) {
        $id_user = $user['id_user'];
        $id_buku = $_POST['id_buku'];
        $current_date = (new DateTime())->format('Y-m-d H:i:s');

        $query = "INSERT INTO peminjaman (id_user, id_buku, tanggal_pinjam) VALUES ('$id_user', '$id_buku', '$current_date')";
        if (mysqli_query($conn, $query)) {
            echo "Data berhasil ditambahkan.";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }  ;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Book</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
    <h1>search page</h1>
</div>

<section class="search-form">
    <form action="" method="post">
        <input type="text" name="search" placeholder="search books..." class="box">
        <input type="submit" name="submit" value="search" class="btn">
    </form>
</section>

<section class="books" style="padding-top: 0;">

    <div class="box-container">
        <?php
        if(isset($_POST['submit'])){
            $search_item = $_POST['search'];
            $select_books = mysqli_query($conn, "SELECT b.*, k.nama_kategori AS kategori FROM buku b JOIN kategori k ON b.id_kategori = k.id_kategori WHERE b.judul LIKE '%{$search_item}%' OR k.nama_kategori LIKE '%{$search_item}%'") or die('query failed');
            if(mysqli_num_rows($select_books) > 0){
                while($data = mysqli_fetch_assoc($select_books)){
        ?>
        <form action="search.php" method="post" class="box" >
            <input type="hidden" name="id_buku" value="<?php echo $data['id_buku']; ?>">
            <input type="hidden" name="pinjamBuku" value="<?php echo true; ?>">
            <img class="image" src="/../resource/img/<?php echo $data['foto']; ?>" alt="" onclick="openModal(<?php echo $data['id_buku']; ?>)" >
            <div class="name"><?php echo $data['judul']; ?></div>
            <div class="details">
                <div class="info">
                    <div class="author"><span>Penulis:</span> <?php echo $data['penulis']; ?></div>
                    <div class="publisher"><span>Penerbit:</span> <?php echo $data['penerbit']; ?></div>
                    <div class="year"><span>Terbit:</span> <?php echo $data['tahun_terbit']; ?></div>
                </div>
            </div>
            <input type="submit" value="Pinjam" name="Pinjam" class="btn" onclick="return confirmSubmit();">
        </form>
        <?php
                }
            } else {
                echo '<p class="empty">no result found!</p>';
            }
        }else{
            echo '<p class="empty">search something!</p>';
        }
        ?>
    </div>
</section>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="script.js"></script>

</body>
</html>