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
if(isset($_POST["submit_kriteria"])){
  buatKriteria($_POST);
}
if(isset($_POST["submit_edit_kriteria"])){
    header("Refresh:0");
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
    </style>
    <title>Daftar Kriteria</title>
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
                        <li class="nav-item active">
                            <a class="nav-link font-navbar" href="kriteria.php">Data Kriteria</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-navbar" href="penerima.php">Data Penerima</a>
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
            <div style="display: flex; justify-content: space-between">
                <h1 class="h1-brand">Data Kriteria</h1>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalKriteria">
                    Tambah Kriteria
                </button>
            </div>
            <div class="tabel">
                <table id="example" class="table table-striped table-bordered" style="width: 100%">
                    <thead class="table-data">
                        <tr>
                            <th>No</th>
                            <th>Nama Kriteria</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dataKriteria = query("SELECT * FROM kriteria");
                        $nomer = 1;
                            foreach($dataKriteria as $kriteria) : ?>
                        <tr>
                            <td><?= $nomer?></td>
                            <td><?= $kriteria["nama_kriteria"] ?></td>
                            <td class="">
                                <ol>
                                    <?php
                                    $idKriteria = $kriteria["id_kriteria"];
                                    $dataKeterangan = query("SELECT * FROM detail_kriteria WHERE id_kriteria = '$idKriteria'");
                                    foreach($dataKeterangan as $dataKeterangan):
                                    ?>
                                    <li><?=$dataKeterangan["keterangan"]?></li>
                                    <?php endforeach; ?>
                                </ol>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-edit" data-id=<?=$idKriteria?>><i
                                        class="fas fa-pencil"></i></button>
                                <button class="btn btn-danger btn-delete" data-id=<?=$idKriteria?>><i
                                        class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php $nomer++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modalKriteria" tabindex="-1" aria-labelledby="modalKriteriaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKriteriaLabel">Tambah Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col col-11">
                                <div class="form-group">
                                    <label for="nama">Nama Kriteria</label>
                                    <input type="text" required class="form-control" name="nama" id="nama"
                                        aria-describedby="emailHelp" />
                                </div>
                            </div>
                        </div>
                        <span>Detail Kriteria</span>
                        <div class="form-row keteranganKriteria">
                            <div class="col col-7 keteranganData" style="margin-bottom: 10px;">
                                <input type="text" required class="form-control" name="keterangan[]"
                                    placeholder="Keterangan">
                            </div>
                            <div class="col col-4 keteranganData" style="margin-bottom: 10px;">
                                <input type="text" required class="form-control" name="nilai[]" placeholder="Nilai">
                            </div>
                        </div>
                        <span class="keterangan" id="tambahKeterangan" style="color:blue; cursor:pointer;"><i
                                class="fa-plus" style="font-size: 22px;"></i>
                            Tambah
                            Keterangan</span>
                        <span class="keterangan" id="hapusKeterangan"
                            style="color:red; cursor:pointer; margin-left: 10px;"><i class="fas fa-trash"
                                style="font-size: 14px;"></i>
                            Hapus
                            Keterangan</span>
                    </div>
                    <div class="row">
                        <div class="col col-11">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" name="submit_kriteria" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div id="kosong"></div>
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
        $("#tambahKeterangan").on("click", function() {
            $(".keteranganKriteria").append(`
                             <div class="col col-7 keteranganData" style="margin-bottom: 10px;">
                                <input type="text" required class="form-control" name="keterangan[]" placeholder="Keterangan">
                            </div>
                            <div class="col col-4 keteranganData" style="margin-bottom: 10px;">
                                <input type="text" required class="form-control" name="nilai[]" placeholder="Nilai">
                            </div>
            `);
        })
        $("#hapusKeterangan").on("click", function() {
            $('.keteranganData:nth-last-child(2)').remove();
            $('.keteranganData').last().remove();
        })
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

        $('.btn-edit').on("click", function() {
            let id = $(this).attr('data-id');
            let formData = new FormData();
            formData.append('id', id);
            fetch('dataKriteria.php', {
                method: 'POST',
                body: formData
            }).then(response => {
                return response.json()
            }).then(responseJson => {
                let data = responseJson;
                let modal = `
                <div class="modal fade" id="modalEditKriteria" tabindex="-1" aria-labelledby="modalKriteriaLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalKriteriaLabel">Edit Kriteria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST">
                                <div class="modal-body">
                                <input type="hidden" class="form-control" name="id_kriteria" id="nama"
                                                    aria-describedby="emailHelp" value="${data[0].id_kriteria}" />
                                    <div class="row">
                                        <div class="col col-11">
                                            <div class="form-group">
                                                <label for="nama">Nama Kriteria</label>
                                                <input type="text" class="form-control" name="nama" id="nama"
                                                    aria-describedby="emailHelp" value="${data[0].nama_kriteria}" />
                                            </div>
                                        </div>
                                    </div>
                                    <span>Detail Kriteria</span>
                                    <div class="form-row keteranganKriteria" id="formEditKeterangan">
                                    ${data.map(data=>`
                                        <div class="col col-7 EditketeranganData" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" name="keterangan[]" placeholder="Keterangan" value="${data.keterangan}">
                                        </div>
                                        <div class="col col-4 EditketeranganData" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" value="${data.nilai}" name="nilai[]" placeholder="Nilai">
                                        </div>
                                        `)}
                                    </div>
                                    <span class="keterangan" id="EdittambahKeterangan" style="color:blue; cursor:pointer;"><i
                                            class="fa-plus" style="font-size: 22px;"></i>
                                        Tambah
                                        Keterangan</span>
                                    <span class="keterangan" id="EdithapusKeterangan"
                                        style="color:red; cursor:pointer; margin-left: 10px;"><i class="fas fa-trash"
                                            style="font-size: 14px;"></i>
                                        Hapus
                                        Keterangan</span>
                                </div>
                                <div class="row">
                                    <div class="col col-11">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            <?php
                                            if(isset($_POST["submit_edit_kriteria"]))
                                                editKriteria($_POST);
                                            ?>
                                            <button type="submit" name="submit_edit_kriteria" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                `
                $("#kosong").html(modal);
                $("#modalEditKriteria").modal("show");
                $("#EdittambahKeterangan").on("click", function() {
                    $("#formEditKeterangan").append(`
                             <div class="col col-7 EditketeranganData" style="margin-bottom: 10px;">
                                <input type="text" class="form-control" name="keterangan[]" placeholder="Keterangan">
                            </div>
                            <div class="col col-4 EditketeranganData" style="margin-bottom: 10px;">
                                <input type="text" class="form-control" name="nilai[]" placeholder="Nilai">
                            </div>
            `);
                })
                $("#EdithapusKeterangan").on("click", function() {
                    $('.EditketeranganData:nth-last-child(2)').remove();
                    $('.EditketeranganData').last().remove();
                })
            })
        })
        $('.btn-delete').on("click", function() {
            let id = $(this).attr('data-id');
            Swal.fire({
                icon: "warning",
                position: "top",
                title: "Apakah anda yakin ?",
                text: "Data Kriteria Akan Terhapus",
                showConfirmButton: true,
                showCancelButton: true,
                reverseButtons: true
            }).then((result => {
                if (result.isConfirmed) {
                    let formData = new FormData;
                    formData.append('id', id);
                    fetch("hapusKriteria.php", {
                        method: "POST",
                        body: formData
                    }).then(response => {
                        return response.json()
                    }).then(responseJson => {
                        Swal.fire({
                            title: 'Terhapus!',
                            text: 'Kriteria Berhasil Dihapus',
                            icon: 'success',
                            position: "top",
                            showConfirmButton: false
                        })
                        setTimeout(() => {
                            window.location.reload(true);
                        }, 1000);
                    })
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Kriteria Gagal Dihapus',
                        icon: 'error',
                        position: "top",
                        showConfirmButton: false
                    })
                    setTimeout(() => {
                        window.location.reload(true);
                    }, 1000);
                }
            }))
        })
    });
    </script>
</body>

</html>