<?php
require_once __DIR__ . '/../../config/database.php';


session_start();

if (!isset($_SESSION["role"])) {
  header("Location: /../");
  exit;
}

if (isset($_POST['add_book'])) {
    $query = "SELECT id_buku FROM buku ORDER BY id_buku DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    $lastID = null;
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        if ($data) {
            $lastID = $data['id_buku'];
        }
    }
    // Buat ID baru dengan format yang diinginkan
    $format = "BK"; // Format id
    if ($lastID) {
        $lastNumber = substr($lastID, 2); // Ambil bagian angka
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); // Naikkan angka dan tambahkan nol di depan
    } else {
        $newNumber = '001'; // Jika belum ada ID, mulai dari 0001
    }
    $id_buku =  $format . $newNumber;
    // $id_buku = mysqli_real_escape_string($conn, $_POST['id_buku']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $penulis = mysqli_real_escape_string($conn, $_POST['penulis']);
    $penerbit = mysqli_real_escape_string($conn, $_POST['penerbit']);
    $tahun_terbit = mysqli_real_escape_string($conn, $_POST['tahun_terbit']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $stok = mysqli_real_escape_string($conn, $_POST['jumlah_halaman']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['sinopsis']);
    $foto = $_FILES['foto']['name'];
    $foto_tmp_name = $_FILES['foto']['tmp_name'];
    $foto_folder = __DIR__ . '/../resource/img/' . $foto;
    
    $add_book_query = mysqli_query($conn, "INSERT INTO `buku`(id_buku, judul, foto, penulis, penerbit, tahun_terbit, id_kategori, jumlah_halaman, sinopsis) VALUES('$id_buku','$judul', '$foto', '$penulis', '$penerbit', '$tahun_terbit', '$kategori','$stok', '$keterangan')") or die('Query failed');
    
    if ($add_book_query) {
        move_uploaded_file($foto_tmp_name, $foto_folder);
        setcookie('message', json_encode(['Book added successfully!']), time() + 10, "/");
    } else {
        setcookie('message', json_encode(['Book addition failed!']), time() + 10, "/");
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT foto FROM `buku` WHERE id_buku = '$delete_id'") or die('Query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink(__DIR__ . '/../resource/img/' . $fetch_delete_image['foto']);
    mysqli_query($conn, "DELETE FROM `buku` WHERE id_buku = '$delete_id'") or die('Query failed');
    header('location:admin_buku.php');
}

if (isset($_POST['update_book'])) {
    $update_b_id = $_POST['update_b_id'];
    $update_judul = mysqli_real_escape_string($conn, $_POST['update_judul']);
    $update_penulis = mysqli_real_escape_string($conn, $_POST['update_penulis']);
    $update_penerbit = mysqli_real_escape_string($conn, $_POST['update_penerbit']);
    $update_tahunterbit = mysqli_real_escape_string($conn, $_POST['update_tahunterbit']);
    $update_kategori = mysqli_real_escape_string($conn, $_POST['update_kategori']);
    $update_stok = mysqli_real_escape_string($conn, $_POST['update_pages']);
    $update_keterangan = mysqli_real_escape_string($conn, $_POST['update_keterangan']);
    $update_foto = $_FILES['update_image']['name'];
    $update_foto_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_foto_folder = __DIR__ . '/../resource/img/' . $update_foto;
    $update_old_image = $_POST['update_old_image'];

    if (!empty($update_foto)) {
        move_uploaded_file($update_foto_tmp_name, $update_foto_folder);
        unlink(__DIR__ . '/../resource/img/' . $update_old_image);
        $update_query = mysqli_query($conn, "UPDATE `buku` SET judul = '$update_judul', penulis = '$update_penulis', penerbit = '$update_penerbit', tahun_terbit = '$update_tahunterbit', id_kategori = '$update_kategori', jumlah_halaman = '$update_stok', sinopsis = '$update_keterangan', foto = '$update_foto' WHERE id_buku = '$update_b_id'") or die('Query failed');
    } else {
        $update_query = mysqli_query($conn, "UPDATE `buku` SET judul = '$update_judul', penulis = '$update_penulis', penerbit = '$update_penerbit', tahun_terbit = '$update_tahunterbit', id_kategori = '$update_kategori', jumlah_halaman = '$update_stok', sinopsis = '$update_keterangan' WHERE id_buku = '$update_b_id'") or die('Query failed');
    }

    if ($update_query) {
        setcookie('message', json_encode(['Book updated successfully!']), time() + 10, "/");
    } else {
        setcookie('message', json_encode(['Book update failed!']), time() + 10, "/");
    }

    header('location:admin_buku.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>

    <!-- Font Awesome CDN link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom admin CSS file link  -->
    <link rel="stylesheet" href="style_admin.css">
    <link rel="icon" type="image/png, image/jpg, image/jpeg" href="/../resource/img/">

</head>

<body>

<?php include 'admin_header.php'; ?>


<!-- Show books section  -->
<section class="show-products">
    <div class="side-btn">
        <div class="kiri"></div>
        <h1 class="title">Library Books</h1>
        <div class="kanan">
            <div class="actions">
                    <a href="admin_buku.php?update=1" class="option-btn">Tambah</a>
                </div>    
        </a></div>
    </div>
    <div class="box-container">
    <?php
    $select_books = mysqli_query($conn, "SELECT * FROM `buku`ORDER BY id_buku DESC") or die('Query failed');
    if (mysqli_num_rows($select_books) > 0) {
        while ($fetch_books = mysqli_fetch_assoc($select_books)) {
    ?>
        <div class="box">
            <div class="baris1">
                <div class="left-column">
                <?php 
                $imagePath = "/../resource/img/" . $fetch_books['foto']; 
                echo "<img src='" . $imagePath . "' alt='Gambar Buku'>";
                ?>
 
                </div>
                <div class="right-column">
                    <div class="name"><?php echo $fetch_books['judul']; ?></div>
                    <div class="separator"></div>
                    <div class="description">
                        <?php echo $fetch_books['sinopsis']; ?>
                    </div>
                </div>
            </div>
            <div class="baris2">
                <div class="info">
                    <div class="author"><span>Penulis:</span> <?php echo $fetch_books['penulis']; ?></div>
                    <div class="publisher"><span>Penerbit:</span> <?php echo $fetch_books['penerbit']; ?></div>
                    <div class="year"><span>Terbit:</span> <?php echo $fetch_books['tahun_terbit']; ?></div>
                    <div class="stock"><span>Jumlah Halaman:</span> <?php echo $fetch_books['jumlah_halaman']; ?></div>
                </div>
                <div class="actions">
                    <a href="admin_buku.php?update=<?php echo $fetch_books['id_buku']; ?>" class="option-btn">Update</a>
                    <a href="admin_buku.php?delete=<?php echo $fetch_books['id_buku']; ?>" class="delete-btn" onclick="return confirm('Delete this book?');">Delete</a>
                </div>
            </div>      
        </div>
    <?php
        }
    } else {
        echo '<p class="empty">No books added yet!</p>';
    }
    ?>
    </div>
</section>

<section class="edit-product-form">
    <?php
    if (isset($_GET['update'])) {
        $update_id = $_GET['update'];
        if ($update_id == 1) {
        ?>
            <form action="admin_buku.php" method="post" enctype="multipart/form-data">
                <h3>Add Book</h3>
                <!-- <input type="text" name="id_buku" class="box" placeholder="Enter id book title" required> -->
                <input type="text" name="judul" class="box" placeholder="Enter book title" required>
                <input type="text" name="penulis" class="box" placeholder="Enter author name" required>
                <input type="text" name="penerbit" class="box" placeholder="Enter publisher name" required>
                <input type="number" min="1500" max="3000" name="tahun_terbit" class="box" placeholder="Enter year of publication" required>
                <label for="kategori">Pilih Kategori:</label>
                    <select name="kategori" id="kategori">
                        <?php
                            $sql = "SELECT id_kategori, nama_kategori FROM kategori";
                            $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data dari setiap baris
                            while($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row["id_kategori"].'">'.$row["nama_kategori"].'</option>';
                            }
                        } else {
                            echo '<option value="">Tidak ada kategori tersedia</option>';
                        }
                        ?>
                </select>
                <input type="number" min="0" name="jumlah_halaman" class="box" placeholder="Enter pages quantity" required>
                <textarea rows="3" name="sinopsis" class="box" placeholder="Enter description" style="resize: none;"></textarea>
                <input type="file" name="foto" accept="image/jpg, image/jpeg, image/png" class="box">
                <input type="submit" value="Add Book" name="add_book" class="btn">
                <input type="button" value="Cancel" id="close-update" class="delete-btn" onclick="window.location.href='admin_buku.php';">
            </form>
        <?php
        } else {
        $update_query = mysqli_query($conn, "SELECT * FROM `buku` WHERE id_buku = '$update_id'") or die('Query failed');
        if (mysqli_num_rows($update_query) > 0) {
            while ($fetch_update = mysqli_fetch_assoc($update_query)) {
    ?>
    <form action="admin_buku.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="update_b_id" value="<?php echo $fetch_update['id_buku']; ?>">
        <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['foto']; ?>">
        <!-- <img src="/../../resource/img/<?php echo $fetch_update['foto']; ?>" alt=""> -->
        <input type="text" name="update_judul" value="<?php echo $fetch_update['judul']; ?>" class="box" required placeholder="Enter book title">
        <input type="text" name="update_penulis" value="<?php echo $fetch_update['penulis']; ?>" class="box" required placeholder="Enter author name">
        <input type="text" name="update_penerbit" value="<?php echo $fetch_update['penerbit']; ?>" class="box" required placeholder="Enter publisher name">
        <input type="number" min="1500" max="3000" name="update_tahunterbit" value="<?php echo $fetch_update['tahun_terbit']; ?>" 
        class="box" required placeholder="Enter year of publication">
        <label for="kategori">Pilih Kategori:</label>
                    <select name="update_kategori" id="kategori">
                        <?php
                            $sql = "SELECT id_kategori, nama_kategori FROM kategori";
                            $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data dari setiap baris
                            while($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row["id_kategori"].'">'.$row["nama_kategori"].'</option>';
                            }
                        } else {
                            echo '<option value="">Tidak ada kategori tersedia</option>';
                        }
                        ?>
                </select>
        <input type="number" name="update_pages" value="<?php echo $fetch_update['jumlah_halaman']; ?>" min="0" class="box" required placeholder="Enter pages quantity">
        <textarea rows="8" name="update_keterangan" class="box" placeholder="Enter description" style="resize: none;"><?php echo $fetch_update['sinopsis']; ?></textarea>
        <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
        <input type="submit" value="Update" name="update_book" class="option-btn">
        <input type="button" value="Cancel" id="close-update" class="delete-btn" onclick="window.location.href='admin_buku.php';">
    </form>
    <?php
            }
        }
        }
    } else {
        echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
    }
    ?>
</section>



<?php include 'admin_footer.php'; ?>

<!-- Custom admin JS file link  -->
<script src="admin_script.js"></script>

</body>

</html>
