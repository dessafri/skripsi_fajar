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

?>