<?php
session_start();
include "../koneksi.php";

// Ambil parameter URL id_nilai (nama parameter GET, bebas, tidak harus sama dengan nama kolom)
if (isset($_GET['Id_nilai'])) {
    $id_nilai = $_GET['Id_nilai'];

    // Kolom Id_nilai sudah berganti nama jadi Nis di database
    $query = mysqli_query($koneksi, "DELETE FROM nilai WHERE `Nis`='$id_nilai'");

    if ($query) {
        // Redirect kembali ke halaman utama jika berhasil
        header("location:index.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    // Jika dikunjungi tanpa parameter id_nilai
    header("location:index.php");
    exit();
}
?>