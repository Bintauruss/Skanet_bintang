<?php
include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mata Pelajaran</title>
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

        input[type="text"] {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        input[type="text"]:focus {
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
        <h1>Tambah Mata Pelajaran</h1>
    </div>

    <form action="simpan.php" method="POST">
        <div class="form-group">
            <label for="mapel">Nama Mata Pelajaran</label>
            <input type="text" id="mapel" name="mapel" placeholder="Masukkan nama mapel" required autocomplete="off">
        </div>

        <div class="button-group">
            <a href="index.php" class="btn btn-cancel">Batal</a>
            <button type="submit" class="btn btn-submit">Simpan Data</button>
        </div>
    </form>
</div>

</body>
</html>