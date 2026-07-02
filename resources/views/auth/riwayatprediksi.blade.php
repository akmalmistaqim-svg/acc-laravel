{{-- resources/views/auth/riwayatprediksi.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Riwayat Prediksi - ACC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-green: #4CAF50;
            --primary-hover: #43a047;
            --light-green: #eaf4ed;
            --bg-light: #f4f9f5;
            --text-dark: #333333;
            --text-muted: #666666;
            --danger-red: #e53e3e;
            --white: #ffffff;
            --border-color: #e2e8f0;
            --blue-primary: #2563eb;
            --blue-hover: #1d4ed8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: var(--white);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-text h1 {
            font-size: 20px;
            color: var(--primary-green);
            font-weight: 700;
            line-height: 1;
        }

        .logo-text span {
            font-size: 11px;
            color: var(--text-muted);
            letter-spacing: 0.5px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 20px;
            list-style: none;
        }

        .nav-item a {
            text-decoration: none;
            color: var(--text-dark);
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            transition: color 0.3s;
        }

        .nav-item a:hover,
        .nav-item.active a {
            color: var(--primary-green);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-name {
            font-size: 14px;
            color: var(--text-dark);
        }

        .btn-logout {
            background-color: var(--danger-red);
            color: var(--white);
            border: none;
            padding: 8px 18px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-transform: uppercase;
            transition: background 0.3s;
        }

        .btn-logout:hover {
            background-color: #c53030;
        }

        .hamburger {
            display: none;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
            padding: 5px;
            z-index: 1001;
        }

        .hamburger span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: var(--primary-green);
            border-radius: 3px;
            transition: 0.3s;
        }

        .content-area {
            flex: 1;
            padding: 110px 5% 50px;
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
        }

        .page-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .page-header h2 {
            font-size: 28px;
            color: var(--primary-green);
            font-weight: 800;
            text-transform: uppercase;
        }

        .page-header p {
            color: var(--text-muted);
            font-size: 14px;
            margin-top: 5px;
        }

        .riwayat-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .riwayat-card {
            background: var(--white);
            border-radius: 14px;
            padding: 16px 22px;
            border: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
            flex-wrap: wrap;
            gap: 12px;
        }

        .riwayat-card:hover {
            border-color: var(--primary-green);
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        }

        .riwayat-left {
            flex: 1;
            min-width: 200px;
        }

        .riwayat-user {
            font-weight: 700;
            font-size: 15px;
            color: var(--text-dark);
        }

        .riwayat-user span {
            font-weight: 400;
            font-size: 13px;
            color: var(--text-muted);
        }

        .riwayat-meta {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .riwayat-right {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .riwayat-suhu {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary-green);
        }

        .riwayat-kondisi {
            font-size: 14px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .riwayat-kondisi .icon {
            font-size: 24px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--border-color);
        }

        .empty-state i {
            font-size: 50px;
            margin-bottom: 15px;
            opacity: 0.3;
        }

        .empty-state a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 24px;
            background: var(--primary-green);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }

        .empty-state a:hover {
            background: var(--primary-hover);
        }

        .pagination-container {
            margin-top: 25px;
            display: flex;
            justify-content: center;
        }

        .pagination-container nav {
            display: flex;
            gap: 6px;
        }

        .pagination-container nav a,
        .pagination-container nav span {
            padding: 8px 14px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            text-decoration: none;
            color: var(--text-dark);
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .pagination-container nav a:hover {
            background: var(--light-green);
            border-color: var(--primary-green);
        }

        .pagination-container nav .active span {
            background: var(--primary-green);
            color: var(--white);
            border-color: var(--primary-green);
        }

        .link-section {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 35px;
            padding: 20px;
            background: #fff;
            border-radius: 14px;
            border: 1px solid var(--border-color);
        }

        .link-btn {
            padding: 12px 28px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        .link-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .link-btn-green {
            background: var(--primary-green);
            color: #fff;
        }
        .link-btn-green:hover {
            background: var(--primary-hover);
        }

        .link-btn-blue {
            background: var(--blue-primary);
            color: #fff;
        }
        .link-btn-blue:hover {
            background: var(--blue-hover);
        }

        .link-section p {
            width: 100%;
            text-align: center;
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        footer {
            background-color: var(--white);
            text-align: center;
            padding: 25px;
            font-size: 13px;
            color: var(--text-muted);
            border-top: 1px solid rgba(0,0,0,0.05);
            margin-top: auto;
        }

        @media (max-width: 768px) {
            .hamburger { 
                display: flex; 
                order: 2;
            }
            .user-profile { 
                order: 3; 
            }
            .user-name { 
                display: none; 
            }
            .nav-menu {
                position: fixed;
                top: -100%;
                left: 0;
                width: 100%;
                flex-direction: column;
                background-color: var(--white);
                text-align: center;
                transition: top 0.4s ease-in-out;
                box-shadow: 0 10px 15px rgba(0,0,0,0.1);
                padding: 20px 0;
                gap: 20px;
                z-index: 999;
                border-bottom: 2px solid var(--primary-green);
            }
            .nav-menu.active {
                top: 70px;
            }
            .hamburger.active span:nth-child(1) {
                transform: rotate(45deg) translate(5px, 5px);
            }
            .hamburger.active span:nth-child(2) {
                opacity: 0;
            }
            .hamburger.active span:nth-child(3) {
                transform: rotate(-45deg) translate(6px, -6px);
            }

            .content-area {
                padding-top: 100px;
            }

            .page-header h2 {
                font-size: 22px;
            }

            .riwayat-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .riwayat-right {
                width: 100%;
                justify-content: flex-start;
            }

            .link-section {
                flex-direction: column;
                align-items: center;
            }
            .link-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo-container">
            <img src="/LogoWeb.png" alt="ACC Logo" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
            <div class="logo-text">
                <h1>ACC</h1>
                <span>Agro Clima Care</span>
            </div>
        </div>

        <ul class="nav-menu" id="navMenu">
            <li class="nav-item"><a href="/dashboard">Beranda</a></li>
            <li class="nav-item"><a href="/cekpenyakit">Identifikasi Penyakit</a></li>
            <li class="nav-item"><a href="/infopenyakit">Info Penyakit</a></li>
            <li class="nav-item"><a href="/hasildiagnosa">Hasil Diagnosa</a></li>
        </ul>

        <div class="user-profile">
            <span class="user-name">Halo, <strong>{{ $namaUser }}</strong></span>
            <button class="btn-logout" onclick="window.location.href='/logout'">Logout</button>
        </div>

        <div class="hamburger" id="hamburgerBtn">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <div class="content-area">
        <div class="page-header">
            <h2>📋 Riwayat Prediksi</h2>
            <p>Daftar prediksi cuaca yang telah dilakukan pengguna</p>
        </div>

        <div class="riwayat-list">
            @forelse($riwayat as $item)
                <div class="riwayat-card">
                    <div class="riwayat-left">
                        <div class="riwayat-user">
                            {{ $item->user->nama ?? 'Pengguna' }}
                            <span>• {{ $item->kota }}</span>
                        </div>
                        <div class="riwayat-meta">
                            <i class="fa-regular fa-calendar"></i>
                            {{ $item->formatted_prediksi_date }} •
                            <i class="fa-regular fa-clock"></i>
                            {{ $item->created_at->format('H:i') }}
                        </div>
                    </div>
                    <div class="riwayat-right">
                        <div class="riwayat-kondisi">
                            @php
                                $icons = [
                                    '01d' => '☀️', '01n' => '🌙',
                                    '02d' => '⛅', '02n' => '☁️',
                                    '03d' => '☁️', '03n' => '☁️',
                                    '04d' => '☁️', '04n' => '☁️',
                                    '09d' => '🌧️', '09n' => '🌧️',
                                    '10d' => '🌦️', '10n' => '🌧️',
                                    '11d' => '⛈️', '11n' => '⛈️',
                                    '13d' => '❄️', '13n' => '❄️',
                                    '50d' => '🌫️', '50n' => '🌫️'
                                ];
                            @endphp
                            <span class="icon">{{ $icons[$item->icon] ?? '⛅' }}</span>
                            {{ $item->kondisi ?? 'Cuaca' }}
                        </div>
                        <div class="riwayat-suhu">
                            {{ $item->suhu }}°C
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fa-solid fa-clock"></i>
                    <h3 style="font-size:18px;color:var(--text-dark);">Belum Ada Riwayat</h3>
                    <p>Lakukan prediksi cuaca di dashboard untuk melihat riwayat di sini.</p>
                    <a href="/dashboard">
                        <i class="fa-solid fa-arrow-left"></i> Ke Dashboard
                    </a>
                </div>
            @endforelse
        </div>

        @if($riwayat->hasPages())
            <div class="pagination-container">
                {{ $riwayat->links() }}
            </div>
        @endif

        <div class="link-section">
            <a href="/kabarsekitar" class="link-btn link-btn-green">
                <i class="fa-solid fa-comment"></i> Kabar Sekitar
            </a>
            <a href="/dashboard" class="link-btn link-btn-blue">
                <i class="fa-solid fa-house"></i> Ke Dashboard
            </a>
            <p>
                <i class="fa-regular fa-bell" style="margin-right:6px;"></i>
                Notifikasi: Bagikan kabar cuaca atau kembali ke dashboard
            </p>
        </div>

    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Website Agro Clima Care (ACC). Semua Hak Dilindungi.</p>
    </footer>

    <script>
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const navMenu = document.getElementById('navMenu');

        hamburgerBtn.addEventListener('click', () => {
            hamburgerBtn.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        document.querySelectorAll('.nav-item a').forEach(link => {
            link.addEventListener('click', () => {
                hamburgerBtn.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });

        window.addEventListener('scroll', () => {
            if (navMenu.classList.contains('active')) {
                hamburgerBtn.classList.remove('active');
                navMenu.classList.remove('active');
            }
        });
    </script>

</body>
</html>