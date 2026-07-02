{{-- resources/views/auth/kabarsekitar.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kabar Sekitar - ACC</title>
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
            --gold: #f59e0b;
            --gold-light: #fef3c7;
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
            margin-bottom: 40px;
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

        .kabar-form {
            background: var(--white);
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            margin-bottom: 35px;
            border: 1px solid var(--border-color);
        }

        .kabar-form h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            font-weight: 600;
            font-size: 14px;
            display: block;
            margin-bottom: 6px;
            color: var(--text-dark);
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--border-color);
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s;
            font-family: 'Poppins', sans-serif;
            background: var(--white);
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: var(--primary-green);
        }

        .form-group textarea {
            min-height: 80px;
            resize: vertical;
        }

        .form-group input[readonly] {
            background: #f8fafc;
            cursor: not-allowed;
        }

        .star-rating {
            display: flex;
            gap: 8px;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 32px;
            color: #d1d5db;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star-rating label:hover,
        .star-rating label:hover~label,
        .star-rating input:checked~label {
            color: var(--gold);
        }

        .btn-submit {
            background: var(--primary-green);
            color: var(--white);
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Poppins', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
        }

        .kabar-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .kabar-card {
            background: var(--white);
            border-radius: 14px;
            padding: 20px 24px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
            transition: all 0.3s;
        }

        .kabar-card:hover {
            border-color: var(--primary-green);
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        }

        .kabar-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .kabar-user {
            font-weight: 700;
            font-size: 16px;
            color: var(--text-dark);
        }

        .kabar-user span {
            font-weight: 400;
            font-size: 13px;
            color: var(--text-muted);
        }

        .kabar-rating {
            font-size: 18px;
            letter-spacing: 2px;
        }

        .kabar-meta {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .kabar-komentar {
            font-size: 14px;
            color: var(--text-dark);
            line-height: 1.6;
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

        .alert-success {
            background: var(--light-green);
            color: var(--primary-green);
            padding: 14px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #c8e6c9;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
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

            .kabar-form {
                padding: 20px;
            }

            .kabar-header {
                flex-direction: column;
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
            <h2>📢 Kabar Sekitar</h2>
            <p>Bagikan kondisi cuaca aktual di daerahmu</p>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="kabar-form">
            <h3>📝 Tulis Kabar</h3>
            <form method="POST" action="{{ route('kabarsekitar.store') }}">
                @csrf

                <div class="form-group">
                    <label>📍 Kota</label>
                    <input type="text" name="kota" value="{{ $kotaTerakhir }}" readonly>
                </div>

                <div class="form-group">
                    <label>⭐ Rating Cuaca</label>
                    <div class="star-rating">
                        <input type="radio" name="rating" id="star5" value="5">
                        <label for="star5">☆</label>
                        <input type="radio" name="rating" id="star4" value="4">
                        <label for="star4">☆</label>
                        <input type="radio" name="rating" id="star3" value="3">
                        <label for="star3">☆</label>
                        <input type="radio" name="rating" id="star2" value="2">
                        <label for="star2">☆</label>
                        <input type="radio" name="rating" id="star1" value="1">
                        <label for="star1">☆</label>
                    </div>
                    @error('rating')
                        <small style="color:red;font-size:12px;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>💬 Komentar</label>
                    <textarea name="komentar" placeholder="Bagikan kondisi cuaca di daerahmu..."></textarea>
                    @error('komentar')
                        <small style="color:red;font-size:12px;">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Kabar
                </button>
            </form>
        </div>

        <h3 style="font-size:18px;font-weight:700;margin-bottom:16px;">
            📋 Kabar dari Pengguna Lain
        </h3>

        <div class="kabar-list">
            @forelse($semuaKabar as $kabar)
                <div class="kabar-card">
                    <div class="kabar-header">
                        <div class="kabar-user">
                            {{ $kabar->user->nama ?? 'Pengguna' }}
                            <span>• {{ $kabar->kota }}</span>
                        </div>
                        <div class="kabar-rating">
                            {!! $kabar->rating_stars !!}
                        </div>
                    </div>
                    <div class="kabar-meta">
                        {{ $kabar->formatted_date }}
                    </div>
                    @if($kabar->komentar)
                        <div class="kabar-komentar">
                            {{ $kabar->komentar }}
                        </div>
                    @endif
                </div>
            @empty
                <div class="empty-state">
                    <i class="fa-solid fa-comment-slash"></i>
                    <h3 style="font-size:18px;color:var(--text-dark);">Belum Ada Kabar</h3>
                    <p>Jadilah orang pertama yang berbagi kabar tentang kondisi cuaca di daerahmu!</p>
                </div>
            @endforelse
        </div>

        <div class="link-section">
            <a href="/riwayatprediksi" class="link-btn link-btn-green">
                <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Prediksi
            </a>
            <a href="/dashboard" class="link-btn link-btn-blue">
                <i class="fa-solid fa-house"></i> Ke Dashboard
            </a>
            <p>
                <i class="fa-regular fa-bell" style="margin-right:6px;"></i>
                Notifikasi: Lihat riwayat prediksi cuaca atau kembali ke dashboard
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