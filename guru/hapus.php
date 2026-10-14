<?php
include "koneksi.php";

$nip = $_GET['nip'];

$query = mysqli_query($koneksi, "DELETE FROM guru WHERE nip='$nip'");

header("Location: index.php");
exit;
?>