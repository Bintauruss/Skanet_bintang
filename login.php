<?php
session_start();
include "koneksi.php";

$error = "";

if (isset($_POST['login'])) {
    // Sanitasi input untuk mencegah SQL Injection dasar
    $username = mysqli_real_escape_string($koneksi, $_POST['Username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'") 
             or die(mysqli_error($koneksi));

    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $_SESSION['status'] = "sukses";
        $_SESSION['username'] = $username;
        $_SESSION['login_alert'] = "Login berhasil! Selamat datang, " . $username . ".";

        header('location:index.php');
        exit();
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Sekolah</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-card {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-header h1 {
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .login-header p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #34495e;
            font-size: 0.95rem;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3498db;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            border: none;
            border-radius: 6px;
            color: white;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-login:hover {
            background-color: #2980b9;
        }

        .error-msg {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <h1>Halaman Login</h1>
            <p>Sistem Informasi Sekolah</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="error-msg"><?= $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="Username">Username</label>
                <input type="text" id="Username" name="Username" placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" name="login" class="btn-login">Login</button>
        </form>
    </div>

</body>
</html>