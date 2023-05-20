<?php 
require "../db.php";

session_start();
if(!isset($_SESSION['admin'])){
  echo "<script>alert('Mohon login terlebih dahulu')
  location.replace('../login.php')</script>";
}

$admins =  $conn->query("SELECT * FROM tbl_admin");
if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $simpan = $conn->query("INSERT INTO tbl_admin VALUES
  (NULL, '$nama', '$username', '$password')");

if ($simpan) {
  echo '<script>alert("Data Berhasil Disimpan");
  location.replace("index.php");</script>';
} else {
  echo '<script>alert("Gagal menyimpan data");
  location.replace("index.php");</script>';
}
}
if (isset($_POST['delete'])) {
  $id = $_POST['id'];
  $delete = $conn->query("DELETE FROM tbl_admin WHERE id_admin = '$id'");
  if ($delete) {
    echo '<script>alert("Data Telah Dihapus");
    location.replace("index.php");</script>';
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | E-Travel</title>
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
            <a class="nav-link" href="../">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../tiket">Tiket</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../transaksi">Transaksi</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <h1 class=" text-dark text-center mt-5"> FORM ADMIN</h1>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow mb-3">
          <div class="card-header bg-dark">
            <h3 class="mb-0 text-white">Tambah Data Admin</h3>
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="row">
                <div class="form-grup">
                  <label class="form-label" for="">Nama</label>
                  <input type="text" required name="nama" id="nama" class="form-control">
                </div>
                <div class="form-grup">
                  <label class="form-label" for="">Username</label>
                  <input type="text" required name="username" id="username" class="form-control">
                </div>
              <div class="form-grup">
                <label class="form-label" for="">Password</label>
                <input type="password" required name="password" id="password" class="form-control">
              </div>
              <div class="form-group text-end">
                <button type="submit" name="simpan" class="btn btn-success btn-md mt-4 w-100">Tambah Admin <i class="bi bi-person-plus-fill"></i></i></button>
              </div>
            </form>
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
                  <th>Username</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($admins as $admin) { ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $admin['nama_admin'] ?></td>
                    <td><?= $admin['username_admin'] ?></td>
                    <td class="text-center">
                      <a href="edit.php?id=<?= $admin['id_admin']?>" class="btn btn-warning text-white btn-sm">Edit <i class="bi bi-pencil-fill"></i></a>
                      <form action="" method="POST">
                        <input type="hidden" name="id" value="<?= $admin['id_admin'] ?>">
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