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
            <th>Nama Buku</th>
            <th>Nama User</th>
            <th>Tanggal Pengembalian</th>
            <th>Denda</th>
            <th class="end">Actions</th>
         </tr>
      </thead>
      <tbody>
         
         <?php
            $select_pengembalian = mysqli_query($conn, "SELECT pengembalian.id_kembali, buku.judul, user.nama, pengembalian.tanggal_pengembalian, pengembalian.denda FROM `pengembalian` JOIN `buku` ON pengembalian.id_buku = buku.id_buku JOIN `user` ON pengembalian.id_user = user.id_user") or die('Query failed');
            while($row = mysqli_fetch_assoc($select_pengembalian)){
         ?>
         <tr>
            <td class="kanan"><?php echo $row['id_pengembalian']; ?></td>
            <td><?php echo $row['judul']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td class="mid"><?php echo $row['tanggal_pengembalian']; ?></td>
            <td class="kanan">Rp <?php echo $row['denda']; ?>,00</td>
            <td class="end">
               <a href="admin_pengembalian.php?update=<?php echo $row['id_pengembalian']; ?>" class="action-btn option-btn">Update</a>
               <a href="admin_pengembalian.php?delete=<?php echo $row['id_pengembalian']; ?>" onclick="return confirm('Delete this entry?');" class="action-btn delete-btn">Delete</a>
            </td>
         </tr>
         <?php
            }
         ?>
         
      </tbody>
   </table>
   </div>

   <?php if (isset($pengembalian_data)) { ?>
      <form action="admin_pengembalian.php" method="post" class="update-form" id="update-pengembalian">
         <h3>Update:</h3>
         <input type="hidden" name="id_pengembalian" value="<?php echo $pengembalian_data['id_pengembalian']; ?>">
         <p> ID Buku: <input type="text" name="id_buku" value="<?php echo $pengembalian_data['id_buku']; ?>" readonly> </p>
         <p> ID User: <input type="text" name="id_user" value="<?php echo $pengembalian_data['id_user']; ?>" readonly> </p>
         <p> Tanggal Pengembalian: <input type="date" name="tanggal_pengembalian" value="<?php echo $pengembalian_data['tanggal_pengembalian']; ?>" readonly> </p>
         <p> Denda: <input type="number" name="denda" value="<?php echo $pengembalian_data['denda']; ?>" readonly> </p>
         <a name="update_pengembalian" class="option-btn btn-disabled">Update</a>
         <a id="close-update" class="delete-btn" onclick="window.location.href='admin_pengembalian.php';">Cancel</a>
         <script>window.location.href='#update-pengembalian';</script>
      </form>
   <?php } ?>

</section>

<?php include 'admin_footer.php'; ?>

<!-- Custom admin JS file link -->
<script src="js/admin_script.js"></script>

</body>
</html>
