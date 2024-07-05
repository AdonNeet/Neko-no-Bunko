<?php
require_once __DIR__ . '/../../config/database.php';


session_start();

if (!isset($_SESSION["role"])) {
  header("Location: /../");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Peminjaman</title>

   <!-- Font Awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom admin CSS file link  -->
   <link rel="stylesheet" href="style_admin.css">
   <link rel="icon" type="image/png" href="images/books.png">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="admin-section">

   <h1 class="title">Peminjaman</h1>
   <div class="container_table">
   <table class="admin-table">
      <thead>
         <tr>
            <th>ID Peminjaman</th>
            <th>Nama Buku</th>
            <th>Nama User</th>
            <th>Tanggal Pinjam</th>
            <th class="end">Tanggal Kembali</th>
         </tr>
      </thead>
      <tbody>
         <?php
            $select_peminjaman = mysqli_query($conn, "SELECT peminjaman.id_pinjam, user.nama, buku.judul, tanggal_pinjam, tanggal_kembali FROM `peminjaman` JOIN `buku` ON peminjaman.id_buku = buku.id_buku JOIN `user` ON peminjaman.id_user = user.id_user") or die('Query failed');
            while($row = mysqli_fetch_assoc($select_peminjaman)){
         ?>
         <tr>
            <td class="kanan"><?php echo $row['id_pinjam']; ?></td>
            <td><?php echo $row['judul']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td class="mid"><?php echo $row['tanggal_pinjam']; ?></td>
            <td class="mid"><?php echo $row['tanggal_kembali']; ?></td>
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
<script src="admin_script.js"></script>

</body>
</html>
