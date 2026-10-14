<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "sukses") {
    header("location:../login.php");
    exit();
}
include "../koneksi.php";

// Query sama seperti di index.php
$query = mysqli_query($koneksi, "SELECT nilai.*, mapel.* 
                                 FROM nilai 
                                 LEFT JOIN mapel ON nilai.`No` = mapel.id_mapel");

if (!$query) {
    die("Query Error: " . mysqli_error($koneksi));
}

// Set header supaya browser download sebagai file CSV
$nama_file = "data_nilai_" . date("Y-m-d") . ".csv";
header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"$nama_file\"");

// Buka output langsung ke browser
$output = fopen("php://output", "w");

// BOM supaya karakter dan Excel kompatibel dengan baik
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// Baris header kolom
fputcsv($output, ["NO", "NIS SISWA", "NIP GURU", "MATA PELAJARAN", "NILAI"]);

// Baris data
while ($data = mysqli_fetch_assoc($query)) {
    $id_nilai   = $data['Nis'] ?? '';
    $nis        = $data['Nama guru'] ?? '';
    $nip        = $data['Nama siswa'] ?? '';
    $nilai_v    = $data['Nip'] ?? '';
    $nama_mapel = $data['mapel'] ?? '-';

    fputcsv($output, [$id_nilai, $nis, $nip, $nama_mapel, $nilai_v]);
}

fclose($output);
exit();
?>