<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "sukses") {
    header("location:../login.php");
    exit();
}
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Id_nilai = $_POST['Id_nilai'] ?? '';
    $nilai    = $_POST['nilai'] ?? '';

    // Kolom Nip di tabel nilai menyimpan nilai (angka), Nis adalah ID-nya
    $stmt = mysqli_prepare($koneksi, "UPDATE nilai SET `Nip` = ? WHERE `Nis` = ?");

    if (!$stmt) {
        die("Prepare Error: " . mysqli_error($koneksi));
    }

    mysqli_stmt_bind_param($stmt, "ds", $nilai, $Id_nilai);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?status=sukses");
        exit;
    } else {
        die("Update Error: " . mysqli_stmt_error($stmt));
    }
}
?>