<?php
require "../db.php";
session_start();
if(!isset($_SESSION['admin'])){
  echo "<script>alert('Mohon login terlebih dahulu')
  location.replace('../login.php')</script>";
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $transk = $conn->query("SELECT * FROM tbl_transaksi WHERE id_transaksi = $id")->fetch_assoc();
}

if(isset($_POST['update'])) {
    $admin = $_POST['admin'];
    $waktu = $_POST['date'];
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    $kmbl = $_POST['kembali'];

    $simpan = mysqli_query($conn, "UPDATE tbl_transaksi SET id_admin ='$admin', tanggal_transaksi = '$waktu', total = '$total', bayar = '$bayar', kembali = '$kmbl' WHERE id_transaksi = '$id'");
    if ($simpan) {
        echo '<script>alert("Data Berhasil DIperbarui");
        location.replace("index.php");</script>';
    } else {
        echo '<script>alert("Data Gagal Ditambah");
        location.replace("index.php");</script>';
    }
}

$view_admin = $conn->query("SELECT * FROM tbl_admin");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaksi | E-Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body>
    
  <h1 class=" text-dark text-center mt-5">Transaksi</h1>
  <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow mb-3">
                    <div class="card-header bg-dark">
                        <h3 class="mb-0 text-white">Edit Data Transaksi </h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-grup mb-3">
                                        <label for="">Admin</label>
                                        <select class="form-select" name="admin" id="admin">
                                            <?php
                                            foreach ($view_admin as $show) { ?>
                                                <option value="<?= $show['id_admin'] ?>"><?= $show['nama_admin'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Tanggal</label>
                                        <input type="date" required name="date" class="form-control" value="<?= $transk['tanggal_transaksi'] ?>">
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Total</label>
                                        <input type="text" required name="total" class="form-control" value="<?= $transk['total'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Bayar</label>
                                        <input type="text" required name="bayar" class="form-control" value="<?= $transk['bayar'] ?>">
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Kembali</label>
                                        <input type="text" required name="kembali" class="form-control" value="<?= $transk['kembali'] ?>">
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>