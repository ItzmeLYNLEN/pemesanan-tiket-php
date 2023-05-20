<?php

require "../../db.php";
session_start();
if(!isset($_SESSION['admin'])){
  echo "<script>alert('Mohon login terlebih dahulu')
  location.replace('../../login.php')</script>";
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $details = $conn->query("SELECT * FROM detail_transaksi WHERE id_detail = $id")->fetch_assoc();
}

if (isset($_POST['update'])) {
    $trx = $_POST['trx'];
    $tkt = $_POST['tkt'];
    $jumlah = $_POST['jumlah'];

    $simpan = mysqli_query($conn, "UPDATE detail_transaksi SET id_transaksi ='$trx', id_tiket = '$tkt', jumlah = '$jumlah' WHERE id_detail = '$id'");

    if ($simpan) {
        echo '<script>alert("Data Diperbarui");
        location.replace("index.php");</script>';
    } else {
        echo '<script>alert("Data Gagal Diperbarui");
        location.replace("index.php");</script>';
    }
}

$view_trx = $conn->query("SELECT * FROM tbl_transaksi");
$view_tiket = $conn->query("SELECT * FROM tbl_tiket");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Transaksi | E-Travel</title>
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
                        <h3 class="mb-0 text-white">Data Transaksi </h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-grup mb-3">
                                        <label for="">ID Transaksi</label>
                                        <select class="form-select" name="trx" id="trx">
                                            <?php
                                            foreach ($view_trx as $show) { ?>
                                                <option value="<?= $show['id_transaksi'] ?>"><?= $show['id_transaksi'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label for="">ID Tiket</label>
                                        <select class="form-select" name="tkt" id="tkt">
                                            <?php
                                            foreach ($view_tiket as $show) { ?>
                                                <option value="<?= $show['id_tiket'] ?>"><?= $show['id_tiket'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Jumlah</label>
                                        <input type="text" required name="jumlah" class="form-control" value="<?= $details['jumlah'] ?>">
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