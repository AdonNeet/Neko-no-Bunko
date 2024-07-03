<?php include('header.php'); ?>
<body>
  <div class="container-fluid">
    <div class="row mt-5">
      <div class="col-md-3">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action">Akun Saya</a>
          <a href="#" class="list-group-item list-group-item-action">Pinjaman Saya</a>
          <a href="#" class="list-group-item list-group-item-action">Keluar</a>
        </div>
      </div>
      <div class="col-md-9">
        <h3>Daftar Pinjaman</h3>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Buku yang dipinjam</th>
              <th scope="col">Tanggal pinjam</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Book Title 1</td>
              <td>2024-06-01</td>
              <td><button class="btn btn-danger">Kembalikan</button></td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Book Title 2</td>
              <td>2024-06-02</td>
              <td><button class="btn btn-danger">Kembalikan</button></td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Book Title 3</td>
              <td>2024-06-03</td>
              <td><button class="btn btn-danger">Kembalikan</button></td>
            </tr>
            <!-- Add more rows as needed -->
          </tbody>
        </table><?php 
  include('header.php'); 
  // Lakukan koneksi ke database sesuai konfigurasi kamu
  
  // Ambil id_akun dari session
  session_start();
  $id_akun = $_SESSION['id_akun']; // Gantikan dengan nama session yang sesuai
  
  // Query untuk mengambil data peminjaman berdasarkan id_akun
  // Misalnya, jika tabel peminjaman kamu bernama 'peminjaman' dan kolom-kolomnya adalah 'id', 'id_akun', 'judul_buku', dan 'tanggal_pinjam'
  // Sesuaikan query ini dengan struktur tabel dan database kamu
  $query = "SELECT * FROM peminjaman WHERE id_akun = $id_akun";
  
  // Eksekusi query
  // $result = mysqli_query($koneksi, $query); // Gantikan $koneksi dengan koneksi database kamu

  // Iterasi hasil query untuk menampilkan data dalam tabel
  $result = [
    ['id' => 1, 'judul_buku' => 'Book Title 1', 'tanggal_pinjam' => '2024-06-01'],
    ['id' => 2, 'judul_buku' => 'Book Title 2', 'tanggal_pinjam' => '2024-06-02'],
    ['id' => 3, 'judul_buku' => 'Book Title 3', 'tanggal_pinjam' => '2024-06-03'],
  ]; // Contoh hasil query untuk simulasi

  ?>

<body>
  <div class="container-fluid">
    <div class="row mt-5">
      <div class="col-md-3">
        <div class="list-group">
          <a href="profile.php" class="list-group-item list-group-item-action">Akun Saya</a>
          <a href="#" class="list-group-item list-group-item-action">Pinjaman Saya</a>
          <a href="/../logout.php" class="list-group-item list-group-item-action">Keluar</a>
        </div>
      </div>
      <div class="col-md-9">
        <h3>Daftar Pinjaman</h3>
        <?php if (!empty($result)): ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Buku yang dipinjam</th>
              <th scope="col">Tanggal pinjam</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($result as $row): ?>
            <tr>
              <th scope="row"><?php echo $row['id']; ?></th>
              <td><?php echo $row['judul_buku']; ?></td>
              <td><?php echo $row['tanggal_pinjam']; ?></td>
              <td><button class="btn btn-danger">Kembalikan</button></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php else: ?>
          <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
          <div class="text-center">
            <div class="row g-2 align-items-center">
              <div>
                <img src="empty_order.png" alt="Empty" class="img-fluid" style="height: 300px; width: 300px">
              </div>
              <div style="width: 35vh">
                <p>Kamu Belum Pernah Meminjam Buku</p><br>
                <p>BuBar memiliki banyak jenis buku yang menunggu untuk dipinjam. </br>Yuk Mulai Pinjam!</p>
                <button class="btn btn-primary">Mulai Pinjam</button>
              </div>
          </div>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>

      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
