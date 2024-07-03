<?php include('header.php'); ?>
<body>
  <div class="container-fluid">
    <div class="row mt-5">
      <div class="col-md-3">
        <div class="list-group">
          <a href="detail/user.html" class="list-group-item list-group-item-action">Akun Saya</a>
          <a href="#" class="list-group-item list-group-item-action">Pinjaman Saya</a>
          <a href="#" class="list-group-item list-group-item-action">Keluar</a>
        </div>
      </div>
      <div class="col-md-9">
        <h3>Daftar Pinjaman</h3>
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
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
