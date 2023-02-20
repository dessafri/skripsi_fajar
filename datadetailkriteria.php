<?php
require './functions.php';

$idKriteria = $_GET["id"];

$data = query("SELECT * FROM detail_kriteria WHERE id_kriteria = '$idKriteria'");

?>