<?php   
require_once __DIR__ . '/../../config/database.php';


session_start();

if (!isset($_SESSION["role"])) {
  header("Location: /../auth");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Panel</title>

   <!-- Font Awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom admin CSS file link  -->
   <link rel="stylesheet" href="style_admin.css">
   <link rel="icon" type="image/png" href="images/books.png">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="dashboard">

   <h1 class="title">Dashboard</h1>

   <div class="box-container">
      <div class="baris1">
         <div class="box">
            <p>Total Buku</p>
            <?php
               $select_buku = mysqli_query($conn, "SELECT COUNT(*) AS total_buku FROM `buku`") or die('Query failed');
               $fetch_buku = mysqli_fetch_assoc($select_buku);
            ?>
            <h3><?php echo $fetch_buku['total_buku']; ?></h3>
            <a href="admin_buku.php" class="btn">Buku</a>
         </div>
         <div class="box">
            <p>Total Users</p>
            <?php
               $select_users = mysqli_query($conn, "SELECT COUNT(*) AS total_users FROM `user`") or die('Query failed');
               $fetch_users = mysqli_fetch_assoc($select_users);
            ?>
            <h3>
               <?php 
               echo $fetch_users['total_users']; 
               ?>
            </h3>
            <a href="admin_user.php" class="btn">User</a>
         </div>
   
         <div class="box">
            <p>Total Peminjaman</p>
            <?php
               $select_peminjaman = mysqli_query($conn, "SELECT COUNT(*) AS total_peminjaman FROM `peminjaman` p LEFT JOIN `pengembalian` k ON p.id_pinjam=k.id_pinjam WHERE k.id_pinjam IS NULL") or die('Query failed');
               $fetch_peminjaman = mysqli_fetch_assoc($select_peminjaman);
            ?>
            <h3><?php echo $fetch_peminjaman['total_peminjaman']; ?></h3>
            <a href="admin_peminjaman.php" class="btn">Peminjaman</a>
         </div>
   
         <div class="box">
            <p>Peminjaman Terlambat</p>
            <?php
               $select_late_peminjaman = mysqli_query($conn, "SELECT COUNT(*) AS total_late FROM `pengembalian` WHERE `denda` > 0") or die('Query failed');
               $fetch_late_peminjaman = mysqli_fetch_assoc($select_late_peminjaman);
            ?>
            <h3><?php echo $fetch_late_peminjaman['total_late']; ?></h3>
            <a href="admin_pengembalian.php" class="btn">Pengembalian</a>
         </div>
      </div>
      <div class="baris2">
         
      </div>
   </div>

</section>

<?php include 'admin_footer.php'; ?>

<!-- Custom admin JS file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
