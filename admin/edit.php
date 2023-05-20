<?php
require "../db.php";

session_start();
if(!isset($_SESSION['admin'])){
  echo "<script>alert('Mohon login terlebih dahulu')
  location.replace('../login.php')</script>";
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $admins = $conn->query("SELECT * FROM tbl_admin WHERE id_admin = $id")->fetch_assoc();
}
if(isset($_POST['update'])){
    $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $simpan = mysqli_query($conn, "UPDATE tbl_admin SET nama_admin = '$nama', username_admin = '$username', password_admin = '$password' WHERE id_admin = '$id'");
  if($simpan) {
    echo '<script>alert("Datanya Berhasil Diperbarui");
    location.replace("index.php");</script>';
  }else{
    echo '<script>alert("Data Gagal Diperbarui");
    location.replace("index.php");</script>';
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Pemesanan Tiket</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow mb-3">
          <div class="card-header bg-dark">
            <h3 class="mb-0 text-white">Edit Data Admin</h3>
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="row">
                <div class="form-grup">
                  <label class="form-label" for="">Nama</label>
                  <input type="text" required name="nama" id="nama" class="form-control" value="<?= $admins['nama_admin'] ?>">
                </div>
                <div class="form-grup">
                  <label class="form-label" for="">Username</label>
                  <input type="text" required name="username" id="username" class="form-control" value="<?= $admins['username_admin'] ?>">
                </div>
              <div class="form-grup">
                <label class="form-label" for="">Password</label>
                <input type="text" required name="password" id="password" class="form-control" value="<?= $admins['password_admin'] ?>">
              </div>
              <div class="form-group text-end">
                <button type="submit" name="update" class="btn btn-success btn-md mt-4 w-100">Perbarui <i class="bi bi-arrow-clockwise"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>