<?php
session_start();
require './functions.php';
$role = $_SESSION["role"];
if ($_SESSION['id'] != '1') {
    header('location: login.php');
    exit();
}

if(isset($_POST["submit_logout"])){
  logout($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/scss/bootstrap.css" />
    <title>Dashboard</title>
</head>

<body>
    <section class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light"
                style="margin: 0; padding-right: 0; padding-left: 0">
                <a class="navbar-brand brand col-2" href="index.php">SPKBNT</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link font-navbar" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-navbar" href="peserta.php">Data Peserta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-navbar" href="kriteria.php">Data Kriteria</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-navbar" href="hasil.php">Hasil</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle font-navbar" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Data Perhitungan
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="entropy.php">Enthropy</a>
                                <a class="dropdown-item" href="mabac.php">Mabac</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <form method="POST" class="form">
                    <button class="btn btn-danger" name="submit_logout">Logout</button>
                </form>
            </nav>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <img class="mx-auto d-block" src="image/bg.jpg" alt="image-bg" />
            <h1 class="text-title text-center">
                SISTEM PENDUKUNG KEPUTUSAN BANTUAN NON TUNAI
            </h1>
        </div>
    </section>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>