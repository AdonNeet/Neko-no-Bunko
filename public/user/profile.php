<?php include('header.php'); ?>
<body>
  <div class="container-fluid">
    <div class="row mt-5">
      <div class="col-md-3">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action">Akun Saya</a>
          <a href="pinjam.php" class="list-group-item list-group-item-action">Pinjaman Saya</a>
          <a href="#" class="list-group-item list-group-item-action">Keluar</a>
        </div>
      </div>
      <div class="col-md-9">
        <h3>Akun Saya</h3>
        <div class="d-flex justify-content-center align-items-center" >
            <div class="text-center">
            <form>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td>
                                <div style="text-align: right;">
                                <label for="namaLengkap">Nama Lengkap:</label>
                              </div>
                            </td>
                            <td>
                                <div style="width: 35vh;">
                                    <input type="text" class="form-control" id="namaLengkap" placeholder="Nama Lengkap">
                                  </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="text-align: right;">
                                    <label for="email">Email:</label>
                                  </div>
                            </td>
                            <td>
                                <div style="width: 35vh;">
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                  </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="text-align: right;">
                                    <label for="jenisKelamin">Jenis Kelamin:</label>
                              </div>
                            </td>
                            <td>
                                <div style="width: 35vh;">
                                    <select class="form-control" id="jenisKelamin">
                                        <option>Laki-laki</option>
                                        <option>Perempuan</option>
                                      </select>
                                  </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="text-align: right;">
                                    <label for="noTelpon">No. Telpon:</label>
                              </div>
                            </td>
                            <td>
                                <div style="width: 35vh;">
                                    <input type="tel" class="form-control" id="noTelpon" placeholder="No. Telpon">
                                  </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="text-align: right;">
                                    <label for="alamat">Alamat:</label>
                              </div>
                            </td>
                            <td>
                                <div style="width: 35vh;">
                                    <textarea class="form-control" id="alamat" rows="3" placeholder="Alamat"></textarea>
                                  </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="text-align: right;">
                                    <a href="#" class="text-primary">Ubah Kata sandi</a>
                              </div>
                            </td>
                            <td>
                                <div style="width: 35vh; text-align: right;">
                                    <button type="submit" class="btn btn-primary">Simpan</button> 
                                  </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
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
