<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Info Penyakit - ACC</title>
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

        .nav-item a:hover, .nav-item.active a {
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

        .hero {
            margin-top: 70px;
            position: relative;
            min-height: 50vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 5%;
            text-align: center;
            background: linear-gradient(rgba(234, 244, 237, 0.75), rgba(234, 244, 237, 0.75)), url('/fotoinfo.jpg') no-repeat center center/cover;
        }

        .hero-content {
            max-width: 800px;
            width: 100%;
        }

        .pill-badge {
            background-color: rgba(255, 255, 255, 0.6);
            color: var(--text-dark);
            padding: 5px 20px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        .hero-title {
            font-size: 38px;
            color: var(--primary-green);
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .hero-description {
            font-size: 16px;
            color: var(--text-dark);
            margin-bottom: 40px;
            line-height: 1.6;
            font-weight: 500;
        }

        .search-box {
            display: flex;
            background: var(--white);
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            max-width: 600px;
            margin: 0 auto;
        }

        .search-box input {
            flex: 1;
            border: none;
            padding: 15px 25px;
            font-size: 15px;
            outline: none;
        }

        .search-box button {
            background: var(--white);
            border: none;
            padding: 0 25px;
            font-size: 20px;
            color: var(--text-dark);
            cursor: pointer;
            transition: color 0.3s;
        }

        .search-box button:hover {
            color: var(--primary-green);
        }

        .filter-section {
            padding: 20px 5%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            background-color: var(--bg-light);
        }

        .filter-label {
            font-weight: 600;
            font-size: 14px;
            color: var(--text-dark);
        }

        .filter-btn {
            background-color: var(--white);
            border: 1px solid #e2e8f0;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }

        .filter-btn:hover {
            border-color: var(--primary-hover);
            color: var(--primary-hover);
        }

        .filter-btn.active {
            border-color: var(--primary-green);
            color: var(--white);
            background-color: var(--primary-green);
        }

        .disease-list {
            padding: 40px 5%;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        .disease-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            cursor: pointer;
        }

        .disease-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            border-color: var(--primary-green);
        }

        .disease-icon {
            font-size: 40px;
            color: var(--primary-green);
            margin-bottom: 15px;
        }

        .disease-card h4 {
            font-size: 16px;
            color: var(--text-dark);
            margin-bottom: 8px;
            font-weight: 700;
        }

        .disease-card h4 a {
            color: var(--text-dark);
            text-decoration: none;
            transition: color 0.3s;
        }

        .disease-card h4 a:hover {
            color: var(--primary-green);
        }

        .disease-card .disease-tag {
            display: inline-block;
            background-color: var(--light-green);
            color: var(--primary-green);
            font-size: 11px;
            font-weight: 600;
            padding: 3px 12px;
            border-radius: 12px;
            margin-top: 10px;
            text-transform: uppercase;
        }

        .disease-card p {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.5;
            margin-top: 8px;
        }

        .disease-card .disease-meta {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 10px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
            grid-column: 1 / -1;
        }

        .empty-state i {
            font-size: 50px;
            margin-bottom: 15px;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-size: 18px;
            color: var(--text-dark);
            margin-bottom: 8px;
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

            .hero { min-height: 40vh; padding-top: 80px; }
            .hero-title { font-size: 26px; }
            .hero-description { font-size: 14px; }
            .disease-list { grid-template-columns: 1fr; }
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
            <li class="nav-item active"><a href="/infopenyakit">Info Penyakit</a></li>
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

    <section class="hero">
        <div class="hero-content">
            <div class="pill-badge">Ensiklopedia Penyakit Tanaman</div>
            <h2 class="hero-title">INFO BERBAGAI<br>PENYAKIT TANAMAN</h2>
            <p class="hero-description">Kumpulan artikel dan sumber terpercaya tentang penyakit tanaman.<br>Klik judul untuk membaca artikel lengkap.</p>
            
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Cari penyakit tanaman..." onkeyup="filterArtikel()">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
    </section>

    <section class="filter-section">
        <span class="filter-label">Filter:</span>
        <button class="filter-btn active" data-filter="semua" onclick="filterTanaman('semua', this)">Semua</button>
        @php
            $tanamanList = $artikel->pluck('jenis_tanaman')->unique();
        @endphp
        @foreach($tanamanList as $tanaman)
            <button class="filter-btn" data-filter="{{ strtolower($tanaman) }}" onclick="filterTanaman('{{ strtolower($tanaman) }}', this)">
                {{ $tanaman }}
            </button>
        @endforeach
    </section>

    <div class="disease-list" id="artikelList">
        @forelse($artikel as $item)
            <div class="disease-card" data-tanaman="{{ strtolower($item->jenis_tanaman) }}" data-judul="{{ strtolower($item->judul) }}">
                <div class="disease-icon">🌿</div>
                <h4>
                    <a href="{{ $item->url_artikel }}" target="_blank">{{ $item->judul }}</a>
                </h4>
                @if($item->deskripsi)
                    <p>{{ Str::limit($item->deskripsi, 120) }}</p>
                @endif
                <span class="disease-tag">{{ $item->jenis_tanaman }}</span>
                @if($item->kategori)
                    <div class="disease-meta">
                        <span>📂 {{ $item->kategori }}</span>
                    </div>
                @endif
            </div>
        @empty
            <div class="empty-state">
                <i class="fa-solid fa-book-open"></i>
                <h3>Belum Ada Artikel</h3>
                <p>Belum ada artikel informasi penyakit yang tersedia. Silakan cek kembali nanti.</p>
            </div>
        @endforelse
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

        // ==========================================
        // FILTER BERDASARKAN TANAMAN
        // ==========================================
        function filterTanaman(tanaman, btn) {
            // Update active button
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const cards = document.querySelectorAll('.disease-card');
            let adaYangTampil = false;

            cards.forEach(card => {
                const dataTanaman = card.getAttribute('data-tanaman');
                if (tanaman === 'semua' || dataTanaman === tanaman) {
                    card.style.display = 'block';
                    adaYangTampil = true;
                } else {
                    card.style.display = 'none';
                }
            });

            // Tampilkan pesan jika tidak ada hasil
            const emptyState = document.querySelector('.empty-state');
            if (!adaYangTampil && !emptyState) {
                // Buat pesan jika belum ada
                const list = document.getElementById('artikelList');
                const msg = document.createElement('div');
                msg.className = 'empty-state';
                msg.innerHTML = `
                    <i class="fa-solid fa-search"></i>
                    <h3>Tidak Ditemukan</h3>
                    <p>Tidak ada artikel untuk tanaman "${tanaman}"</p>
                `;
                list.appendChild(msg);
            } else if (adaYangTampil && emptyState) {
                emptyState.remove();
            }
        }

        // ==========================================
        // PENCARIAN ARTIKEL
        // ==========================================
        function filterArtikel() {
            const keyword = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.disease-card');
            let adaYangTampil = false;

            cards.forEach(card => {
                const judul = card.getAttribute('data-judul') || '';
                const tanaman = card.getAttribute('data-tanaman') || '';
                const deskripsi = card.querySelector('p')?.textContent?.toLowerCase() || '';

                if (judul.includes(keyword) || tanaman.includes(keyword) || deskripsi.includes(keyword)) {
                    card.style.display = 'block';
                    adaYangTampil = true;
                } else {
                    card.style.display = 'none';
                }
            });

            // Reset filter buttons
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            document.querySelector('.filter-btn[data-filter="semua"]')?.classList.add('active');

            // Tampilkan pesan jika tidak ada hasil
            const emptyState = document.querySelector('.empty-state');
            if (!adaYangTampil && !emptyState) {
                const list = document.getElementById('artikelList');
                const msg = document.createElement('div');
                msg.className = 'empty-state';
                msg.innerHTML = `
                    <i class="fa-solid fa-search"></i>
                    <h3>Tidak Ditemukan</h3>
                    <p>Tidak ada artikel dengan kata kunci "${keyword}"</p>
                `;
                list.appendChild(msg);
            } else if (adaYangTampil && emptyState) {
                emptyState.remove();
            }
        }
    </script>
</body>
</html>