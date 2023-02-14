<?php $conn = mysqli_connect('localhost', 'root', '', 'spkbnt');

if (!$conn) {
    mysqli_error($koneksi);
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
function login($data)
{
    global $conn;
    $username = $data['username'];
    $password = $data['password'];

    $hasil = query(
        "SELECT * FROM user WHERE username = '$username' AND password = '$password' "
    );
    if ($hasil != null) {
        $_SESSION['id'] = '1';
        $_SESSION['role'] = $hasil[0]["role"];
        header('location: index.php');
        exit();
    } else {
        echo "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        
        alert('Username / Password Salah !!');
        </script>
        
        ";
    }
}
function logout()
{
    header('location: login.php');
    session_start();
    session_destroy();
    $_SESSION['id'] = '';
}
function buatKriteria($data){
    global $conn;
    $nama = $data["nama"];
    $keterangan = $data["keterangan"];
    $nilai = $data["nilai"];
    
    $sqlKriteria = "INSERT INTO kriteria (id_kriteria, nama_kriteria) VALUES (NULL, '$nama')";
    mysqli_query($conn, $sqlKriteria);
    $sqlKriteria = query(
        'SELECT * FROM kriteria ORDER BY id_kriteria DESC LIMIT 1'
    );
    $idKriteria = $sqlKriteria[0]['id_kriteria'];
    $sqlDetailKriteria = 'INSERT INTO detail_kriteria (id_detail_kriteria, id_kriteria, keterangan, nilai) VALUES';
    $index = 0;
    foreach($keterangan as $keterangan){
        $nilai1 = $nilai[$index++];
        $sqlDetailKriteria .=
                        "(NULL,'" .
                        $idKriteria .
                        "','" .
                        $keterangan .
                        "','" .
                        $nilai1 .
                        "'),";
    }
    $sqlDetailKriteria = rtrim($sqlDetailKriteria, ', ');
    mysqli_query($conn, $sqlDetailKriteria);
}
function editKriteria($data){
    global $conn;
    $idKriteria = $data["id_kriteria"];
    $nama = $data["nama"];
    $keterangan = $data["keterangan"];
    $nilai = $data["nilai"];

    $sqlUpdateKriteria = "UPDATE kriteria SET nama_kriteria= '$nama' WHERE id_kriteria = '$idKriteria'";
    mysqli_query($conn,$sqlUpdateKriteria);

    $sqlDelete = "DELETE FROM detail_kriteria WHERE id_kriteria = '$idKriteria'";
    mysqli_query($conn,$sqlDelete);
    $sqlDetailKriteria = 'INSERT INTO detail_kriteria (id_detail_kriteria, id_kriteria, keterangan, nilai) VALUES';
    $index = 0;
    foreach($keterangan as $keterangan){
        $nilai1 = $nilai[$index++];
        $sqlDetailKriteria .=
                        "(NULL,'" .
                        $idKriteria .
                        "','" .
                        $keterangan .
                        "','" .
                        $nilai1 .
                        "'),";
    }
    $sqlDetailKriteria = rtrim($sqlDetailKriteria, ', ');
    mysqli_query($conn, $sqlDetailKriteria);
}
function deleteKriteria($data){
    global $conn;

    $id = $data['id'];
    mysqli_query($conn, "DELETE FROM kriteria WHERE id_kriteria='$id'");
    mysqli_query($conn, "DELETE FROM detail_kriteria WHERE id_kriteria='$id'");
}
function buatPeserta($data){
    global $conn;
    $nik = $data["nik"];
    $nama = $data["nama"];
    $jenis_kelamin = $data["jenis_kelamin"];
    $tanggal_lahir = $data["date"];
    $alamat = $data["alamat"];
    $alamatUpper = strtoupper($alamat);
    $rt = $data["rt"];
    $rw = $data["rw"];

    mysqli_query($conn, "INSERT INTO peserta (id_peserta, nik, nama, jenis_kelamin, tanggal_lahir, alamat, rt, rw) VALUES (NULL, '$nik', '$nama', '$jenis_kelamin', '$tanggal_lahir', '$alamatUpper', '$rt', '$rw')");
    
    $keterangan = $data["keterangan"];
    $sqljawaban = "INSERT INTO jawaban (id_jawaban, nik, id_kriteria, jawaban_peserta) VALUES";
    foreach($keterangan as $idKriteria){
        $jawaban = $data[$idKriteria];
        $sqljawaban .=
                        "(NULL,'" .
                        $nik .
                        "','" .
                        $idKriteria .
                        "','" .
                        $jawaban .
                        "'),";
    }
    $sqljawaban = rtrim($sqljawaban, ', ');
    mysqli_query($conn, $sqljawaban);
}

function buatHasil(){
    global $conn;
    $dataPeserta = query("SELECT * FROM peserta");
    // normalisasi entropy
    foreach($dataPeserta as $dataPeserta){
        $nikPeserta = $dataPeserta["nik"];
        $dataPerKriteria = query("SELECT jawaban.id_kriteria, jawaban.jawaban_peserta, jawaban.nik FROM jawaban WHERE nik = $nikPeserta");
        $sqlNormalisasiEntropy = 'INSERT INTO normaliasi_entropy (id_normalisasi_entropy, nik, id_kriteria, nilai_normaliasi_entropy) VALUES';
        foreach($dataPerKriteria as $dataPerKriteria){
            $idKriteria = $dataPerKriteria["id_kriteria"];
            $sumKriteria = query("SELECT SUM(jawaban_peserta) as TOTAL FROM jawaban WHERE id_kriteria = $idKriteria");
            $sum = $sumKriteria[0]["TOTAL"];
            $jawaban = $dataPerKriteria["jawaban_peserta"];
            $normalisasi = $jawaban / $sum;
            $sqlNormalisasiEntropy .=
                        "(NULL,'" .
                        $nikPeserta .
                        "','" .
                        $idKriteria .
                        "','" .
                        $normalisasi .
                        "'),";
        }
        // $sqlNormalisasiEntropy = rtrim($sqlNormalisasiEntropy, ', ');
        // mysqli_query($conn, $sqlNormalisasiEntropy);
    }
    // entropy tiap atribut
    $dataPesertaNormalisasi = query("SELECT * FROM peserta");
    $sqlEntropy = 'INSERT INTO entropy_tiap_atribut (id_entropy_tiap_atribut, nik, id_kriteria, nilai_entropy_tiap_atribut) VALUES';
    foreach($dataPesertaNormalisasi as $dataPesertaNormalisasi){
        $nikPesertaNormalisasi = $dataPesertaNormalisasi["nik"];
        $dataNormalisasi = query("SELECT * FROM normaliasi_entropy WHERE nik = $nikPesertaNormalisasi");
        foreach($dataNormalisasi as $dataNormalisasi){
            $idKriteria = $dataNormalisasi["id_kriteria"];
            $nilai_normalisasi = $dataNormalisasi["nilai_normaliasi_entropy"];
            $nilaiLogNormaliasi = log($nilai_normalisasi);
            $nilaiEntropy = $nilai_normalisasi * $nilaiLogNormaliasi;
            $sqlEntropy .=
                        "(NULL,'" .
                        $nikPesertaNormalisasi .
                        "','" .
                        $idKriteria .
                        "','" .
                        $nilaiEntropy .
                        "'),";
        }
    }
    // $sqlEntropy = rtrim($sqlEntropy, ', ');
    // mysqli_query($conn, $sqlEntropy);

    // ej
    $dataKriteria = query("SELECT * FROM kriteria");
    $sqlEj = 'INSERT INTO ej (id_ej,id_kriteria, nilai_ej) VALUES';
    foreach($dataKriteria as $dataKriteria){
        $idKriteria = $dataKriteria["id_kriteria"];
        $sumPeserta = query("SELECT COUNT(DISTINCT nik) as TOTAL FROM peserta");
        $sumKriteria = query("SELECT SUM(nilai_entropy_tiap_atribut) as TOTAL FROM entropy_tiap_atribut WHERE id_kriteria = $idKriteria");
        $totalPeserta = $sumPeserta[0]["TOTAL"];
        $sum = abs($sumKriteria[0]["TOTAL"]);
        // var_dump($sum);
        $ej = (1/log($totalPeserta))*$sum;
        $ej1 = abs(1-$ej);
        $sqlEj .=
                        "(NULL,'" .
                        $idKriteria .
                        "','" .
                        $ej1 .
                        "'),";
    }
    //  $sqlEj = rtrim($sqlEj, ', ');
    // mysqli_query($conn, $sqlEj);

    // bobot entropy
    $dataKriteria = query("SELECT * FROM ej");
    $sumEj = query("SELECT SUM(nilai_ej) as TOTAL FROM ej WHERE id_kriteria");
    $sqlBobot = 'INSERT INTO bobot_entropy (id_bobot,id_kriteria, nilai_bobot) VALUES';
    foreach($dataKriteria as $dataKriteria){
        $idKriteria = $dataKriteria["id_kriteria"];
        $sum = abs($sumEj[0]["TOTAL"]);
        $nilaiEj = $dataKriteria["nilai_ej"]; 
        $bobot = $nilaiEj / $sum;;
        $sqlBobot .=
                        "(NULL,'" .
                        $idKriteria .
                        "','" .
                        $bobot .
                        "'),";
    }
    $sqlBobot = rtrim($sqlBobot, ', ');
    mysqli_query($conn, $sqlBobot);
}

?>