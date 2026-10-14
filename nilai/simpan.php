<?php
include "../koneksi.php";

$nis = $_POST['nis'];
$nip = $_POST['nip'];
$id_mapel = $_POST['Id_mapel'];
$nilai = $_POST['nilai'];

mysqli_query($koneksi, "INSERT INTO nilai (nis, nip, Id_mapel, nilai) VALUES('$nis', '$nip', '$Id_mapel', '$nilai')");
header("location:index.php");
?>