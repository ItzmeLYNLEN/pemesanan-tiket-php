<?php

require '../db.php';

session_start();
if(!isset($_SESSION['admin'])){
  echo "<script>alert('Mohon login terlebih dahulu')
  location.replace('../login.php')</script>";
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $admins = $conn->query("SELECT * FROM tbl_tiket WHERE id_tiket = $id")->fetch_assoc();
}


if(isset($_POST['update'])){
    $jns = $_POST['jns'];
    $nama = $_POST['nama'];
    $tujuan = $_POST['tujuan'];
    $harga = $_POST['harga'];
    $waktu = $_POST['date'];
  

  $simpan = mysqli_query($conn, "UPDATE tbl_tiket SET id_jenis_tiket ='$jns',harga_tiket = '$harga',tujuan = '$tujuan',nama =  '$nama',waktu = '$waktu' WHERE id_tiket = '$id'");

  if($simpan) {
    echo '<script>alert("Datanya Berhasil Diperbarui");
    location.replace("index.php");</script>';
  }else{
    echo '<script>alert("Data Gagal Diperbarui");
    location.replace("index.php");</script>';
  }
}
$view_jenis = $conn->query("SELECT * FROM tbl_jenis_tiket");
$tikets = $conn->query("SELECT * FROM tbl_tiket WHERE id_tiket = '$id'")->fetch_assoc();
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tiket | Pemesanan Tiket</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow mb-3">
                    <div class="card-header bg-dark">
                        <h3 class="mb-0 text-white">Edit Tiket</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="form-grup mb-3">
                                    <label for="">Jenis Tiket</label>
                                    <select class="form-select" name="jns" id="jns">
                                        <?php
                                        foreach ($view_jenis as $show) { ?>
                                            <option value="<?= $show['id_jenis'] ?>"><?= $show['jenis'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-grup mb-3">
                                    <label for="">Nama</label>
                                    <input type="text" required name="nama" class="form-control" value="<?= $tikets['nama'] ?>">
                                </div>
                                <div class="form-grup mb-3">
                                    <label for="">Tujuan</label>
                                    <input type="text" required name="tujuan" class="form-control" value="<?= $tikets['tujuan'] ?>">
                                </div>
                                <div class="form-grup mb-3">
                                    <label for="">Harga</label>
                                    <input type="text" required name="harga" class="form-control" value="<?= $tikets['harga_tiket'] ?>">
                                </div>
                                <div class="form-grup mb-3">
                                    <label for="">Waktu</label>
                                    <input type="date" required name="date" class="form-control" value="<?= $tikets['waktu'] ?>">
                                </div>
                            </div>
                            <div class="form-group text-end">
                                <button type="submit" name="update" class="btn btn-success btn-lg w-100 mt-4">Perbarui <i class="bi bi-arrow-clockwise"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>