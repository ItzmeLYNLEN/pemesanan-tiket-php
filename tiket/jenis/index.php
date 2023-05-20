<?php
require "../../db.php";

session_start();
if(!isset($_SESSION['admin'])){
  echo "<script>alert('Mohon login terlebih dahulu')
  location.replace('../../login.php')</script>";
}

$jenisTiket = $conn->query("SELECT * FROM tbl_jenis_tiket");
if (isset($_POST['simpan'])) {
  $jns = $_POST['jns'];

  $simpan = $conn->query("INSERT INTO tbl_jenis_tiket VALUES(NULL, '$jns')");

  if ($simpan) {
    echo '<script>alert("Data Berhasil Ditambahkan");
    location.replace("index.php");</script>';
  } else {
    echo '<script>alert("Data Gagal Ditambah");
    location.replace("index.php");</script>';
  }
}

if (isset($_POST['delete'])) {

  $id = $_POST['id'];

  $delete = $conn->query("DELETE FROM tbl_jenis_tiket WHERE id_jenis = '$id'");

  if ($delete) {
      echo '<script>alert("Datanya DIhapus");
    location.replace("index.php");</script>';
  }else{
      echo "<script>alert('data error')</script>";
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jenis | Pemesanan Tiket</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow mb-3">
          <div class="card-header bg-dark">
            <h3 class="mb-0 text-white">Tambah Jenis Tiket</h3>
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="row">
                <div class="form-grup">
                  <label class="form-label" for="">Jenis Tiket</label>
                  <input type="text" required name="jns" id="jns" class="form-control">
                </div>
              </div>
              <div class="form-group text-end">
                <button type="submit" name="simpan" class="btn btn-success btn-lg w-100 mt-4">Tambah</button>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card shadow">
              <div class="card-body">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Jenis Tiket</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    foreach ($jenisTiket as $jenis) { ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $jenis['jenis'] ?></td>
                        <td class="text-center">
                          <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $jenis['id_jenis'] ?>">
                            <button type="submit" name="delete" class="btn btn-danger text-white btn-sm">Delete</button>
                          </form>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <a href="../"><button class="btn btn-primary btn-lg w-100 mt-4">Kembali</button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>