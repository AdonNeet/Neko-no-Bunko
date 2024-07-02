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
        </table>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
