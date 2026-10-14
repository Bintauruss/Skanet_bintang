<?php
include "koneksi.php";
$nip=$_POST['nis'];
$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$query=mysqli_query($koneksi,"update siswa set nama='$nama',alamat='$alamat' where nis='$nis'");
header('location:index.php');