<?php
// 1. Mencegah error 'session is already active'
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Proteksi Halaman: Cek apakah user sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "sukses") {
    header("Location: ../login.php");
    exit();
}

// 3. Hubungkan ke koneksi database (karena di dalam folder 'siswa', pakai ../)
include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f4f7f6;
            padding: 40px 20px;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        h1 {
            font-size: 24px;
            color: #2c3e50;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: background 0.2s, transform 0.1s;
        }

        /* Style untuk Tombol Menu Utama */
        .btn-menu {
            background-color: #6c757d;
            color: white;
        }

        .btn-menu:hover {
            background-color: #5a6268;
        }

        .btn-add {
            background-color: #2ea44f;
            color: white;
        }

        .btn-add:hover {
            background-color: #2c974b;
        }

        .btn-edit {
            background-color: #3182ce;
            color: white;
            padding: 6px 12px;
            font-size: 13px;
        }

        .btn-edit:hover {
            background-color: #2b6cb0;
        }

        .btn-delete {
            background-color: #e53e3e;
            color: white;
            padding: 6px 12px;
            font-size: 13px;
            margin-right: 5px;
        }

        .btn-delete:hover {
            background-color: #c53030;
        }

        .btn:active {
            transform: scale(0.98);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 8px;
        }

        th, td {
            padding: 14px 16px;
            text-align: left;
        }

        th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        tr {
            border-bottom: 1px solid #edf2f7;
            transition: background-color 0.2s;
        }

        tr:hover {
            background-color: #f8fafc;
        }

        tr:last-child {
            border-bottom: none;
        }

        .actions {
            white-space: nowrap;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Data Siswa</h1>
        <div class="action-buttons">
            <!-- Tombol Kembali ke Menu Utama -->
            <a href="../index.php" class="btn btn-menu">&larr; Menu Utama</a>
            <a href="tambah.php" class="btn btn-add">+ Tambah Data</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th style="width: 140px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM siswa");
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?= htmlspecialchars($data['nis']) ?></td>
                    <td><?= htmlspecialchars($data['nama']) ?></td>
                    <td><?= htmlspecialchars($data['alamat']) ?></td>
                    <td class="actions">
                        <a href="edit.php?nis=<?= $data['nis'] ?>" class="btn btn-edit">Edit</a>
                        <a href="hapus.php?nis=<?= $data['nis'] ?>" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>