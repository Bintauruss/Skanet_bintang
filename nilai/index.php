<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "sukses") {
    header("location:../login.php");
    exit();
}
include "../koneksi.php";

// Query JOIN: nilai.No (dulu Id_mapel) di-JOIN ke mapel.id_mapel
$query = mysqli_query($koneksi, "SELECT nilai.*, mapel.* 
                                 FROM nilai 
                                 LEFT JOIN mapel ON nilai.`No` = mapel.id_mapel");

if (!$query) {
    die("Query Error: " . mysqli_error($koneksi));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai</title>
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
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

        h1 {
            font-size: 24px;
            color: #2c3e50;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
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

        .btn-add {
            background-color: #2ea44f;
            color: white;
        }

        .btn-add:hover {
            background-color: #2c974b;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-edit {
            background-color: #3182ce;
            color: white;
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-edit:hover {
            background-color: #2b6cb0;
        }

        .btn-delete {
            background-color: #e53e3e;
            color: white;
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 4px;
            text-decoration: none;
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
            text-align: center;
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

        .badge-nilai {
            background-color: #ebf8ff;
            color: #3182ce;
            font-weight: bold;
            padding: 4px 10px;
            border-radius: 4px;
            display: inline-block;
        }

        .no-data {
            text-align: center;
            color: #718096;
            font-style: italic;
        }

        .btn-print {
            background-color: #3182ce;
            color: white;
            cursor: pointer;
        }

        .btn-print:hover {
            background-color: #2b6cb0;
        }

        .btn-export {
            background-color: #38a169;
            color: white;
        }

        .btn-export:hover {
            background-color: #2f855a;
        }

        /* Saat print, sembunyikan tombol dan kolom Aksi, hanya tabel yang tercetak */
        @media print {
            body {
                background: white;
                padding: 0;
                display: block;
            }

            .container {
                box-shadow: none;
                max-width: 100%;
                padding: 0;
            }

            .nav-buttons {
                display: none;
            }

            .btn-edit,
            .btn-delete {
                display: none;
            }

            th:last-child,
            td:last-child {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Data Nilai</h1>
        <div class="nav-buttons">
            <a href="../index.php" class="btn btn-secondary">← Menu Utama</a>
            <a href="tambah.php" class="btn btn-add">+ Tambah Data</a>
            <button type="button" onclick="window.print()" class="btn btn-print">🖨 Print</button>
            <a href="export.php" class="btn btn-export">⬇ Export</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID NILAI</th>
                <th>NIS</th>
                <th>NIP</th>
                <th>MATA PELAJARAN</th>
                <th>NILAI</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
                    // Nama kolom sudah disesuaikan dengan struktur tabel nilai yang baru:
                    // Id_nilai -> Nis, nis -> `Nama guru`, nip -> `Nama siswa`, nilai -> Nip
                    $id_nilai = $data['Nis'] ?? '';
                    $nis      = $data['Nama guru'] ?? '';
                    $nip      = $data['Nama siswa'] ?? '';
                    $nilai_v  = $data['Nip'] ?? '';

                    // Nama mata pelajaran (dari tabel mapel)
                    $nama_mapel = $data['mapel'] ?? '-';
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($id_nilai); ?></td>
                    <td><?php echo htmlspecialchars($nis); ?></td>
                    <td><?php echo htmlspecialchars($nip); ?></td>
                    <td><?php echo htmlspecialchars($nama_mapel); ?></td>
                    <td>
                        <span class="badge-nilai"><?php echo htmlspecialchars($nilai_v); ?></span>
                    </td>
                    <td>
                        <a href="edit.php?Id_nilai=<?php echo urlencode($id_nilai); ?>" 
                           class="btn btn-edit">Edit</a>
                        <a href="hapus.php?Id_nilai=<?php echo urlencode($id_nilai); ?>" 
                           class="btn btn-delete" 
                           onclick="return confirm('Yakin ingin menghapus data nilai ini?')">Hapus</a>
                    </td>
                </tr>
            <?php 
                }
            } else {
            ?>
                <tr>
                    <td colspan="6" class="no-data">Belum ada data nilai.</td>
                </tr>
            <?php 
            } 
            ?>
        </tbody>
    </table>
</div>

</body>
</html>