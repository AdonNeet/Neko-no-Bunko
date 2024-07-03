<?php
require_once __DIR__ . '/../../config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pengembalian</title>

   <!-- Font Awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom admin CSS file link  -->
   <link rel="stylesheet" href="style_admin.css">
   <link rel="icon" type="image/png" href="/../../resource/img/books.png">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="admin-section">

   <h1 class="title">Pengembalian</h1>
   <div class="container_table">
   <table class="admin-table">
      <thead>
         <tr>
            <th>ID Pengembalian</th>
            <th>ID Pinjam</th>
            <th>Nama Buku</th>
            <th>Nama User</th>
            <th>Tanggal Pengembalian</th>
            <th class="end">Denda</th>
         </tr>
      </thead>
      <tbody>
         
         <?php
            $select_pengembalian = mysqli_query($conn, "SELECT pengembalian.id_pengembalian, pengembalian.id_pinjam, buku.judul, user.nama, pengembalian.tanggal_pengembalian, pengembalian.denda FROM `pengembalian` JOIN peminjaman ON pengembalian.id_pinjam = peminjaman.id_pinjam JOIN user ON peminjaman.id_user = user.id_user JOIN buku ON peminjaman.id_buku = buku.id_buku;") or die('Query failed');
            while($row = mysqli_fetch_assoc($select_pengembalian)){
         ?>
         <tr>
            <td class="kanan"><?php echo $row['id_pengembalian']; ?></td>
            <td class="kanan"><?php echo $row['id_pinjam']; ?></td>
            <td><?php echo $row['judul']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td class="mid"><?php echo $row['tanggal_pengembalian']; ?></td>
            <td class="kanan">Rp <?php echo $row['denda']; ?>,00</td>
         </tr>
         <?php
            }
         ?>
         
      </tbody>
   </table>
   </div>

</section>

<?php include 'admin_footer.php'; ?>

<!-- Custom admin JS file link -->
<script src="js/admin_script.js"></script>

</body>
</html>
