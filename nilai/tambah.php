<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "sukses") {
    header("location:../login.php");
    exit();
}
include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Nilai</title>
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
            max-width: 500px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .header {
            margin-bottom: 25px;
            text-align: center;
        }

        h1 {
            font-size: 22px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
            color: #475569;
        }

        input[type="number"], select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
            background-color: #fff;
        }

        input[type="number"]:focus, select:focus {
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.15);
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background 0.2s, transform 0.1s;
        }

        .btn-submit {
            background-color: #2ea44f;
            color: white;
        }

        .btn-submit:hover {
            background-color: #2c974b;
        }

        .btn-cancel {
            background-color: #e2e8f0;
            color: #475569;
        }

        .btn-cancel:hover {
            background-color: #cbd5e1;
        }

        .btn:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Tambah Data Nilai</h1>
    </div>

    <form action="proses_tambah.php" method="POST">
        <!-- Dropdown Siswa -->
        <div class="form-group">
            <label>Siswa (NIS):</label>
            <select name="nis" required>
                <option value="">-- Pilih Siswa --</option>
                <?php
                $query_siswa = mysqli_query($koneksi, "SELECT * FROM siswa");
                while ($s = mysqli_fetch_array($query_siswa)) {
                    echo "<option value='".$s['nis']."'>".$s['nis']." - ".$s['nama']."</option>";
                }
                ?>
            </select>
        </div>

        <!-- Dropdown Guru -->
        <div class="form-group">
            <label>Guru (NIP):</label>
            <select name="nip" required>
                <option value="">-- Pilih Guru --</option>
                <?php
                $query_guru = mysqli_query($koneksi, "SELECT * FROM guru");
                while ($g = mysqli_fetch_array($query_guru)) {
                    echo "<option value='".$g['nip']."'>".$g['nip']." - ".$g['nama']."</option>";
                }
                ?>
            </select>
        </div>

        <!-- Dropdown Mapel -->
        <div class="form-group">
            <label>Mata Pelajaran:</label>
            <select name="id_mapel" required>
                <option value="">-- Pilih Mapel --</option>
                <?php
                $query_mapel = mysqli_query($koneksi, "SELECT * FROM mapel");
                while ($m = mysqli_fetch_array($query_mapel)) {
                    echo "<option value='".$m['id_mapel']."'>".$m['mapel']."</option>";
                }
                ?>
            </select>
        </div>

        <!-- Input Nilai -->
        <div class="form-group">
            <label>Nilai:</label>
            <input type="number" name="nilai" required placeholder="Masukkan nilai">
        </div>

        <div class="button-group">
            <a href="index.php" class="btn btn-cancel">Batal</a>
            <button type="submit" name="simpan" class="btn btn-submit">Simpan</button>
        </div>
    </form>
</div>

</body>
</html>