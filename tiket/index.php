<?php
require "../db.php";


session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Mohon login terlebih dahulu')
  location.replace('../login.php')</script>";
}

$tikets = $conn->query("SELECT * FROM tbl_tiket");
if (isset($_POST['simpan'])) {
    $jns = $_POST['jns'];
    $nama = $_POST['nama'];
    $tujuan = $_POST['tujuan'];
    $harga = $_POST['harga'];
    $waktu = $_POST['date'];

    $simpan = $conn->query("INSERT INTO tbl_tiket VALUES(NULL,'$jns', '$harga', '$tujuan', '$nama','$waktu')");

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

    $delete = $conn->query("DELETE FROM tbl_tiket WHERE id_tiket = '$id'");

    if ($delete) {
        echo '<script>alert("Datanya Dihapus");
      location.replace("index.php");</script>';
    } else {
        echo "<script>alert('data error')</script>";
    }
}

$view_jenis = $conn->query("SELECT * FROM tbl_jenis_tiket");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tiket | E-Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="../">E-Travel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/index.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Tiket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../transaksi">Transaksi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow mb-3">
                    <div class="card-header bg-dark">
                        <h3 class="mb-0 text-white">Tambah Tiket </h3>
                        <a href="jenis"><button class="btn btn-warning btn-lg text-white w-100 mt-4">+ Jenis Tiket</button></a>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-lg-6">
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
                                        <label class="form-label" for="">Nama</label>
                                        <input type="text" required name="nama" class="form-control">
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Tujuan</label>
                                        <input type="text" required name="tujuan" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Harga</label>
                                        <input type="text" required name="harga" class="form-control">
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Waktu</label>
                                        <input type="date" required name="date" class="form-control">
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <table class=" table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Tujuan</th>
                                <th>Harga</th>
                                <th>Waktu</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($tikets as $tiket) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $tiket['nama'] ?></td>
                                    <td><?= $tiket['id_jenis_tiket'] ?></td>
                                    <td><?= $tiket['tujuan'] ?></td>
                                    <td><?= $tiket['harga_tiket'] ?></td>
                                    <td><?= $tiket['waktu'] ?></td>
                                    <td class="text-center">
                                        <a href="edit-tiket.php?id=<?= $tiket['id_tiket'] ?>" class="btn btn-warning text-white btn-sm">Edit <i class="bi bi-pencil-fill"></i></a>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?= $tiket['id_tiket'] ?>">
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

</html>