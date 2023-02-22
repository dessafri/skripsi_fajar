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
if(isset($_POST["hitung_hasil"])){
    buatHasil($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/scss/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap4.min.css" />
    <style>
    .swal2-popup {
        font-size: 12px !important;
        font-family: Georgia, serif;
    }

    h2 {
        margin-top: 30px;
        margin-bottom: 30px;
        font-size: 18px;
    }
    </style>
    <title>Hasil</title>
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
                        <li class="nav-item">
                            <a class="nav-link font-navbar" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-navbar" href="peserta.php">Data Peserta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-navbar" href="kriteria.php">Data Kriteria</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-navbar active" href="hasil.php">Hasil</a>
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
            <div style="display: flex; justify-content: space-between">
                <h1 class="h1-brand" style="font-size:22px;">HASIL PENERIMAAN BANTUAN</h1>
            </div>
            <div class="normalisasi-data" id="normalisasi" style="margin-bottom:50px;">
                <table id="example" class="table table-striped table-bordered" style="width: 100%">
                    <thead class="table-data">
                        <tr>
                            <th>No</th>
                            <th>PESERTA</th>
                            <th>NIK</th>
                            <th>HASIL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $jumlah = query("SELECT peserta.nama, peserta.nik, perangkingan_alternatif.nilai_perankingan_alternatif FROM perangkingan_alternatif LEFT JOIN peserta ON peserta.nik = perangkingan_alternatif.nik ORDER BY perangkingan_alternatif.nilai_perankingan_alternatif DESC");
                        if(count($jumlah) > 0){
                            $index = 1;
                            foreach($jumlah as $dataPeserta):
                            ?>
                        <tr>
                            <td><?= $index++?></td>
                            <td><?= $dataPeserta["nama"]?></td>
                            <td><?= $dataPeserta["nik"]?></td>
                            <td><?= $dataPeserta["nilai_perankingan_alternatif"]?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php }?>

                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col text-center">
                    <?php
                    $jumlah = query("SELECT * FROM perangkingan_alternatif");
                    if(count($jumlah) > 1){
                        echo '
                    <button class="btn btn-secondary" disabled id="hitung">Hitung Hasil</button>
                        ';
                    }else{
                        echo '
                        <form method="POST">
                            <button name="hitung_hasil" class="btn btn-primary" id="hitung">Hitung Hasil</button>
                        </form>
                        ';
                    }
                    ?>
                </div>
            </div>
        </div>

    </section>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
        integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
    $(document).ready(function() {
        var table = $("#example").DataTable({
            lengthChange: true,
            buttons: [{
                    extend: "excel",
                    text: "Export Excel",
                    className: "btn-success",
                },
                {
                    extend: "spacer",
                    style: "bar",
                },
                {
                    extend: "pdf",
                    text: "Export PDF",
                    className: "btn-danger"
                },
                {
                    extend: "spacer",
                    style: "bar",
                },
                {
                    extend: "colvis",
                    text: "SORTIR"
                },
            ],
        });
        table
            .buttons()
            .container()
            .appendTo("#example_wrapper .col-md-6:eq(0)");
    });
    </script>
</body>

</html>