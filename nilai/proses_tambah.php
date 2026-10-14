<?php
session_start();
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $nis      = $_POST['nis'];
    $nip      = $_POST['nip'];
    $id_mapel = $_POST['id_mapel'];
    $nilai    = $_POST['nilai'];

    // Validasi: pastikan semua dropdown sudah dipilih (tidak kosong)
    // Kalau ada yang kosong, tolak simpan supaya tidak masuk ke database sebagai 0
    if ($nis === '' || $nip === '' || $id_mapel === '' || $nilai === '') {
        echo "Gagal menyimpan data: semua field wajib diisi (Siswa, Guru, Mapel, dan Nilai tidak boleh kosong).";
        echo "<br><a href='tambah.php'>Kembali ke form</a>";
        exit();
    }

    // Nama kolom sudah disesuaikan dengan struktur tabel nilai yang baru:
    // nis -> `Nama guru`, nip -> `Nama siswa`, id_mapel -> `No`, nilai -> `Nip`
    $query = mysqli_query($koneksi, "INSERT INTO nilai (`Nama guru`, `Nama siswa`, `No`, `Nip`) VALUES ('$nis', '$nip', '$id_mapel', '$nilai')");

    if ($query) {
        // Jika berhasil, kembali ke halaman utama tabel nilai
        header("location:index.php");
        exit();
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}
?>