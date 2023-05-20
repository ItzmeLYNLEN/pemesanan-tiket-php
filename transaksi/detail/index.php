<?php

require "../../db.php";
session_start();
if(!isset($_SESSION['admin'])){
  echo "<script>alert('Mohon login terlebih dahulu')
  location.replace('../../login.php')</script>";
}

$details = $conn->query("SELECT * FROM detail_transaksi");
if (isset($_POST['simpan'])) {
    $trx = $_POST['trx'];
    $tkt = $_POST['tkt'];
    $jumlah = $_POST['jumlah'];

    $simpan = $conn->query("INSERT INTO detail_transaksi VALUES(NULL, '$trx', '$tkt', '$jumlah')");

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

    $delete = $conn->query("DELETE FROM detail_transaksi WHERE id_detail = '$id'");

    if ($delete) {
        echo '<script>alert("Datanya Dihapus");
      location.replace("index.php");</script>';
    } else {
        echo "<script>alert('data error')</script>";
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
    
  <div class="container">
    <a href="../"><button class="btn btn-warning btn-lg text-white mt-4"><i class="bi bi-arrow-90deg-left"></i> Kembali</button></a>
  </div>
  <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow mb-3">
                    <div class="card-header bg-dark">
                        <h3 class="mb-0 text-white">Detail Transaksi </h3>
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
                                        <input type="text" required name="jumlah" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group text-end">
                                    <button type="submit" name="simpan" class="btn btn-success btn-lg w-100 mt-4"><i class="bi bi-plus"></i> Tambah</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-body">
                <table class=" table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Id Transaksi</th>
                                <th>Id Tiket</th>
                                <th>Jumlah</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($details as $detail) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $detail['id_transaksi'] ?></td>
                                    <td><?= $detail['id_tiket'] ?></td>
                                    <td><?= $detail['jumlah'] ?></td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $detail['id_detail'] ?>" class="btn btn-warning text-white btn-sm">Edit <i class="bi bi-pencil-fill"></i></a>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?= $detail['id_detail'] ?>">
                                            <button type="submit" name="delete" class="btn btn-danger text-white btn-sm">Delete <i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>