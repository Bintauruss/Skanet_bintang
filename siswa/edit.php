<?php
include "koneksi.php";

// Mengambil NIS dari URL
$nis = $_GET['nis'];
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");
$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
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

        input[type="text"], textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        input[type="text"]:focus, textarea:focus {
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.15);
        }

        input[readonly] {
            background-color: #f1f5f9;
            color: #64748b;
            cursor: not-allowed;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
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
            background-color: #3182ce;
            color: white;
        }

        .btn-submit:hover {
            background-color: #2b6cb0;
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
        <h1>Edit Data Siswa</h1>
    </div>

    <form action="update.php" method="POST">
        <div class="form-group">
            <label for="nis">NIS</label>
            <!-- NIS dibuat readonly karena merupakan Primary Key (identitas utama) -->
            <input type="text" id="nis" name="nis" value="<?= htmlspecialchars($data['nis']) ?>" readonly>
        </div>

        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required autocomplete="off">
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" required><?= htmlspecialchars($data['alamat']) ?></textarea>
        </div>

        <div class="button-group">
            <a href="index.php" class="btn btn-cancel">Batal</a>
            <button type="submit" class="btn btn-submit">Simpan Perubahan</button>
        </div>
    </form>
</div>

</body>
</html>