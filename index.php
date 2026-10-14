<?php
// Mencegah error 'session is already active'
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['status']) || $_SESSION['status'] != "sukses") {
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Skanet Bintang</title>
    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-dark: #090d16;
            --card-bg: rgba(18, 24, 38, 0.85);
            --card-border: rgba(99, 102, 241, 0.25);
            --primary-glow: #6366f1;
            --accent-glow: #ec4899;
            --text-main: #f3f4f6;
            --text-muted: #9ca3af;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
            position: relative;
            padding: 20px;
        }

        /* Background Animated Neon Glows */
        .gaming-bg-glow {
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
            opacity: 0.35;
        }

        .glow-1 {
            top: -100px;
            left: -100px;
            background: #4f46e5;
        }

        .glow-2 {
            bottom: -100px;
            right: -100px;
            background: #db2777;
        }

        /* Container Utama */
        .container {
            width: 100%;
            max-width: 800px;
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
        }

        /* Alert Sukses */
        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Header Styling */
        .header {
            text-align: center;
            margin-bottom: 35px;
        }

        .header h1 {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(to right, #ffffff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
        }

        .header p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* Menu Grid Layout */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 18px;
        }

        /* Menu Card Styling */
        .menu-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--text-main);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .menu-card:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-glow);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.25);
        }

        /* Ikon Kotak Kartu */
        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.25rem;
            color: white;
            margin-right: 18px;
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        /* Variasi Warna Gradasi Ikon */
        .bg-guru { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
        .bg-mapel { background: linear-gradient(135deg, #10b981, #047857); }
        .bg-siswa { background: linear-gradient(135deg, #f59e0b, #b45309); }
        .bg-nilai { background: linear-gradient(135deg, #ef4444, #b91c1c); }

        .card-content {
            flex-grow: 1;
        }

        .card-content h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 3px;
            color: #ffffff;
        }

        .card-content p {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .card-arrow {
            color: var(--text-muted);
            font-size: 0.9rem;
            transition: transform 0.3s ease;
        }

        .menu-card:hover .card-arrow {
            transform: translateX(4px);
            color: var(--primary-glow);
        }

        /* Logout Button */
        .logout-wrapper {
            margin-top: 35px;
            text-align: center;
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 12px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 650px) {
            .container { padding: 20px; }
            .header h1 { font-size: 1.7rem; }
            .menu-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

   <?php
// Mencegah error 'session is already active'
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['status']) || $_SESSION['status'] != "sukses") {
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Skanet Bintang</title>
    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-dark: #090d16;
            --card-bg: rgba(18, 24, 38, 0.85);
            --card-border: rgba(99, 102, 241, 0.25);
            --primary-glow: #6366f1;
            --accent-glow: #ec4899;
            --text-main: #f3f4f6;
            --text-muted: #9ca3af;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
            position: relative;
            padding: 20px;
        }

        /* Background Animated Neon Glows */
        .gaming-bg-glow {
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
            opacity: 0.35;
        }

        .glow-1 {
            top: -100px;
            left: -100px;
            background: #4f46e5;
        }

        .glow-2 {
            bottom: -100px;
            right: -100px;
            background: #db2777;
        }

        /* Container Utama */
        .container {
            width: 100%;
            max-width: 800px;
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
        }

        /* Alert Sukses */
        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Header Styling */
        .header {
            text-align: center;
            margin-bottom: 35px;
        }

        .header h1 {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(to right, #ffffff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
        }

        .header p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* Menu Grid Layout */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 18px;
        }

        /* Menu Card Styling */
        .menu-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--text-main);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .menu-card:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-glow);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.25);
        }

        /* Ikon Kotak Kartu */
        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.25rem;
            color: white;
            margin-right: 18px;
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        /* Variasi Warna Gradasi Ikon */
        .bg-guru { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
        .bg-mapel { background: linear-gradient(135deg, #10b981, #047857); }
        .bg-siswa { background: linear-gradient(135deg, #f59e0b, #b45309); }
        .bg-nilai { background: linear-gradient(135deg, #ef4444, #b91c1c); }

        .card-content {
            flex-grow: 1;
        }

        .card-content h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 3px;
            color: #ffffff;
        }

        .card-content p {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .card-arrow {
            color: var(--text-muted);
            font-size: 0.9rem;
            transition: transform 0.3s ease;
        }

        .menu-card:hover .card-arrow {
            transform: translateX(4px);
            color: var(--primary-glow);
        }

        /* Logout Button */
        .logout-wrapper {
            margin-top: 35px;
            text-align: center;
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 12px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 650px) {
            .container { padding: 20px; }
            .header h1 { font-size: 1.7rem; }
            .menu-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- Background Glow Effects -->
    <div class="gaming-bg-glow glow-1"></div>
    <div class="gaming-bg-glow glow-2"></div>

    <div class="container">

        <?php if (isset($_SESSION['login_alert'])): ?>
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> 
                <span><?= htmlspecialchars($_SESSION['login_alert']) ?></span>
            </div>
            <?php unset($_SESSION['login_alert']); ?>
        <?php endif; ?>

        <!-- Header Section -->
        <div class="header">
            <h1>Dashboard Skanet Bintang</h1>
            <p>Selamat datang, Boss! Silakan pilih menu navigasi di bawah untuk mengelola data sistem.</p>
        </div>

        <!-- Menu Grid -->
        <div class="menu-grid">
            <a href="guru/index.php" class="menu-card">
                <div class="card-icon bg-guru">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div class="card-content">
                    <h3>Data Guru</h3>
                    <p>Kelola informasi pengajar</p>
                </div>
                <div class="card-arrow"><i class="fa-solid fa-chevron-right"></i></div>
            </a>

            <a href="mapel/index.php" class="menu-card">
                <div class="card-icon bg-mapel">
                    <i class="fa-solid fa-book-open-reader"></i>
                </div>
                <div class="card-content">
                    <h3>Data Mapel</h3>
                    <p>Daftar mata pelajaran RPL</p>
                </div>
                <div class="card-arrow"><i class="fa-solid fa-chevron-right"></i></div>
            </a>

            <a href="siswa/index.php" class="menu-card">
                <div class="card-icon bg-siswa">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <div class="card-content">
                    <h3>Data Siswa</h3>
                    <p>Database warga akademik</p>
                </div>
                <div class="card-arrow"><i class="fa-solid fa-chevron-right"></i></div>
            </a>

            <a href="nilai/index.php" class="menu-card">
                <div class="card-icon bg-nilai">
                    <i class="fa-solid fa-file-invoice"></i>
                </div>
                <div class="card-content">
                    <h3>Data Nilai</h3>
                    <p>Rekap nilai dan rapor</p>
                </div>
                <div class="card-arrow"><i class="fa-solid fa-chevron-right"></i></div>
            </a>
        </div>

        <!-- Logout Action -->
        <div class="logout-wrapper">
            <a href="logout.php" class="btn-link btn-logout">
                <i class="fa-solid fa-power-off"></i> Sign Out
            </a>
        </div>
        
    </div>
</body>
</html>
</body>
</html> 