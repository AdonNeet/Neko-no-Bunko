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
            <th>Tanggal Kembali</th>
            <th class="end">Actions</th>
         </tr>
      </thead>
      <tbody>
         <?php
            $select_peminjaman = mysqli_query($conn, "SELECT peminjaman.id_peminjaman, buku.judul, user.nama, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali FROM `peminjaman` JOIN `buku` ON peminjaman.id_buku = buku.id_buku JOIN `user` ON peminjaman.id_user = user.id_user") or die('Query failed');
            while($row = mysqli_fetch_assoc($select_peminjaman)){
         ?>
         <tr>
            <td class="kanan"><?php echo $row['id_peminjaman']; ?></td>
            <td><?php echo $row['judul']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td class="mid"><?php echo $row['tanggal_pinjam']; ?></td>
            <td class="mid"><?php echo $row['tanggal_kembali']; ?></td>
            <td class="end">
               <a href="admin_peminjaman.php?update=<?php echo $row['id_peminjaman']; ?>" class="action-btn option-btn">Update</a>
               <a href="admin_peminjaman.php?delete=<?php echo $row['id_peminjaman']; ?>" onclick="return confirm('Delete this entry?');" class="action-btn delete-btn">Delete</a>
            </td>
         </tr>
         <?php
            }
         ?>
      </tbody>
   </table>
   </div>

   <?php if 
   (isset($peminjaman_data)) { ?>
      <form action="admin_peminjaman.php" method="post" class="update-form" id="update-peminjaman">
         <h3>Update:</h3>
         <input type="hidden" name="id_peminjaman" value="<?php echo $peminjaman_data['id_peminjaman']; ?>">
         <p> ID Buku: <input type="text" name="id_buku" value="<?php echo $peminjaman_data['id_buku']; ?>" readonly> </p>
         <p> ID User: <input type="text" name="id_user" value="<?php echo $peminjaman_data['id_user']; ?>" readonly> </p>
         <p> Tanggal Pinjam: <input type="date" name="tanggal_pinjam" value="<?php echo $peminjaman_data['tanggal_pinjam']; ?>" readonly> </p>
         <p> Tanggal Kembali: <input type="date" name="tanggal_kembali" value="<?php echo $peminjaman_data['tanggal_kembali']; ?>" required> </p>
         <a name="update_peminjaman" class="option-btn">Update</a>
         <a id="close-update" class="delete-btn" onclick="window.location.href='admin_peminjaman.php';">Cancel</a>
         <script>window.location.href='#update-peminjaman';</script>
      </form>
   <?php } ?>

</section>

<?php include 'admin_footer.php'; ?>

<!-- Custom admin JS file link -->
<script src="js/admin_script.js"></script>

</body>
</html>
