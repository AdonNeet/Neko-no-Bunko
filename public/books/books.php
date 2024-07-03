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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $user['id_user'];
    $id_buku = $_POST['id_buku'];
    $current_date = (new DateTime())->format('Y-m-d H:i:s');

    $query = "INSERT INTO peminjaman (id_user, id_buku, tanggal_pinjam) VALUES ('$id_user', '$id_buku', '$current_date')";
    if (mysqli_query($conn, $query)) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Books</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style_books.css">
    <link rel="icon" type="image/png, image/jpg, image/jpeg" href="/../resource/img/">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading" style="background-color: #FFA500; padding: 7vh;">
    <h1>Books</h1>
</div>

<section class="books">
    <div style="text-align:center;">
        <h2 class="title">latest books</h2>
    </div>
    <div class="box-container" href="book_detail.php">
        <?php  
        $select_books = mysqli_query($conn, "SELECT * FROM buku ORDER BY buku.tahun_terbit DESC") or die('query failed');
        if(mysqli_num_rows($select_books) > 0){
            while($data = mysqli_fetch_assoc($select_books)){
                ?>

        <form action="books.php" method="post" class="box">
            <img class="image" src="/../resource/img/<?php echo $data['foto']; ?>" alt="" onclick="openModal(<?php echo $data['id_buku']; ?>)">
            <div class="name"><?php echo $data['judul']; ?></div>
            <input type="hidden" name="id_buku" value="<?php echo $data['id_buku']; ?>">
            <a href="book_detail.php?id_buku=<?php $data['id_buku']; ?>">
                <img class="image" src="/../resource/img/<?php echo $data['foto']; ?>" alt="" onclick="openModal(<?php echo $data['id_buku']; ?>)" >
            </a>
            <div class="name"><?php echo $data['judul']; ?></div>
            <div class="details">
                <div class="info">
                    <div class="author"><span>Penulis:</span> <?php echo $data['penulis']; ?></div>
                    <div class="publisher"><span>Penerbit:</span> <?php echo $data['penerbit']; ?></div>
                    <div class="year"><span>Terbit:</span> <?php echo $data['tahun_terbit']; ?></div>
                </div>
            </div>
            <input type="submit" value="Pinjam" name="submit" class="btn" onclick="return confirmSubmit();">
        </form>
        <?php
        }
        } else {
         echo '<p class="empty">no products added yet!</p>';
        }
        ?>
    </div>
    
    <div class="load-more" style="margin-top: 2rem; text-align:center">
        <a href="" class=""></a>
    </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>