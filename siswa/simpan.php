<?php
// 1. Mencegah error 'session is already active'
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Proteksi Halaman: Cek apakah user sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] !== "sukses") {
    header("Location: ../login.php");
    exit();
}

// 3. Hubungkan ke database
include "../koneksi.php";

// 4. Pastikan data dikirim via metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil data dan hilangkan spasi tidak perlu
    $nis    = trim($_POST['nis'] ?? '');
    $nama   = trim($_POST['nama'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');

    // Cek apakah NIS, Nama, dan Alamat tidak kosong
    if (!empty($nis) && !empty($nama) && !empty($alamat)) {
        
        $stmt = mysqli_prepare($koneksi, "INSERT INTO siswa (nis, nama, alamat) VALUES (?, ?, ?)");
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $nis, $nama, $alamat);
            
            // Menggunakan try-catch untuk menangkap error duplicate entry
            try {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                
                // Berhasil
                header("Location: index.php?status=sukses");
                exit();

            } catch (mysqli_sql_exception $e) {
                // Cek apakah errornya karena duplikat data (Error Code 1062)
                if ($e->getCode() === 1062) {
                    echo "<script>
                            alert('Gagal! NIS $nis sudah terdaftar di database.');
                            window.location.href = 'tambah.php';
                          </script>";
                    exit();
                } else {
                    // Jika error lain
                    die("Gagal menyimpan data: " . $e->getMessage());
                }
            }
        } else {
            die("Gagal menyiapkan statement: " . mysqli_error($koneksi));
        }

    } else {
        echo "<script>
                alert('Semua data (NIS, Nama, Alamat) wajib diisi!');
                window.location.href = 'tambah.php';
              </script>";
        exit();
    }

} else {
    header("Location: index.php");
    exit();
}
?>