<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteksi Session (harus login)
if (!isset($_SESSION['status']) || $_SESSION['status'] != "sukses") {
    header("Location: ../login.php");
    exit();
}

include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mapel = trim($_POST['mapel'] ?? '');

    // Cukup cek input $mapel saja (karena id_mapel otomatis terisi oleh database)
    if (!empty($mapel)) {
        $query = "INSERT INTO mapel (mapel) VALUES ('$mapel')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            header("Location: index.php?status=sukses");
            exit();
        } else {
            die("Gagal menyimpan data: " . mysqli_error($koneksi));
        }
    } else {
        echo "<script>
                alert('Nama mata pelajaran tidak boleh kosong!');
                window.location.href = 'tambah.php';
              </script>";
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>