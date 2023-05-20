<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>E-Travel</title>
    <style>
      .haha{
        margin-top: 10%;
      }
    </style>
</head>
<?php

session_start();
include "db.php";


if(!isset($_SESSION['admin'])){
    echo "<script>alert('Mohon login terlebih dahulu')
    location.replace('login.php')</script>";
}
?>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="#">E-Travel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="#">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin">Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tiket">Tiket</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="transaksi">Transaksi</a>
        </li>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
      <li class="nav-item">
          <a class="nav-link" href="logout.php">Log Out <i class="bi bi-box-arrow-right"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <section id="banner">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 haha">
            <h5 class="text-success">Bus Ticket</h5>
            <h2>Have Fun Your Road Trip !</h2>
            <p>Hopefully reach your destination safely, have a nice day buddy, don't forget to comeback ! </p>
            <a href="tiket"><button class="btn btn-success btn-md">Order Now <i class="bi bi-ticket-perforated"></i></button></a>
          </div>
          <div class="col-lg-6">
            <img class="ms-5 py-3" id="lani" src="assets/lani.png" alt="" width="100%" height="auto">
          </div>
        </div>
      </div>

    </section>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>