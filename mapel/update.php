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
    $id_mapel = $_POST['id_mapel'] ?? '';
    $mapel    = trim($_POST['mapel'] ?? '');

    if (!empty($id_mapel) && !empty($mapel)) {
        $query = "UPDATE mapel SET mapel='$mapel' WHERE id_mapel='$id_mapel'";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            header("Location: index.php?status=updated");
            exit();
        } else {
            die("Gagal memperbarui data: " . mysqli_error($koneksi));
        }
    } else {
        echo "<script>
                alert('Data tidak boleh kosong!');
                window.location.href = 'index.php';
              </script>";
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>