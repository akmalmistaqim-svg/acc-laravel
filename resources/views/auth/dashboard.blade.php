<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ACC - Agro Clima Care Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
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
        display: flex; justify-content: space-between; align-items: center;
        padding: 15px 5%; box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        position: fixed; width: 100%; top: 0; z-index: 1000;
    }
    .logo-container { display: flex; align-items: center; gap: 10px; }
    .logo-text h1 { font-size: 20px; color: var(--primary-green); font-weight: 700; line-height: 1; }
    .logo-text span { font-size: 11px; color: var(--text-muted); letter-spacing: 0.5px; }
    .nav-menu { display: flex; align-items: center; gap: 20px; list-style: none; }
    .nav-item a { text-decoration: none; color: var(--text-dark); font-size: 13px; font-weight: 600; text-transform: uppercase; transition: color 0.3s; }
    .nav-item a:hover, .nav-item.active a { color: var(--primary-green); }
    .user-profile { display: flex; align-items: center; gap: 15px; }
    .user-name { font-size: 14px; color: var(--text-dark); }
    .btn-logout {
        background-color: var(--danger-red); color: var(--white); border: none;
        padding: 8px 18px; border-radius: 6px; font-size: 13px; font-weight: 600;
        cursor: pointer; text-transform: uppercase; transition: background 0.3s;
    }
    .btn-logout:hover { background-color: #c53030; }
    .hamburger {
        display: none;
        cursor: pointer;
        flex-direction: column;
        gap: 5px;
        padding: 5px;
        z-index: 1001;
    }
    .hamburger span { display: block; width: 25px; height: 3px; background-color: var(--primary-green); border-radius: 3px; transition: 0.3s; }

    .hero {
        margin-top: 75px; position: relative; min-height: 50vh;
        display: flex; align-items: center; padding: 50px 5%;
        background: linear-gradient(rgba(244, 249, 245, 0.70), rgba(244, 249, 245, 0.70)), url('/fotopetani.jpg.jpeg') no-repeat center center/cover;
    }
    .hero-content { max-width: 650px; }
    .hero-title { font-size: 36px; color: var(--primary-green); font-weight: 700; line-height: 1.2; margin-bottom: 15px; }
    .hero-description { font-size: 15px; color: var(--text-muted); margin-bottom: 30px; line-height: 1.6; }
    .btn-cta {
        background-color: var(--primary-green); color: var(--white); border: none;
        padding: 12px 25px; border-radius: 8px; font-size: 14px; font-weight: 600;
        display: inline-flex; align-items: center; gap: 10px; cursor: pointer;
        text-transform: uppercase; box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
        transition: transform 0.3s, background-color 0.3s;
        text-decoration: none;
    }
    .btn-cta:hover { background-color: var(--primary-hover); transform: translateY(-2px); }

    .features {
        padding: 40px 5% 60px 5%; display: grid;
        grid-template-columns: repeat(3, 1fr); gap: 30px;
        margin-top: -50px; position: relative; z-index: 10;
    }
    .card { background-color: var(--white); padding: 35px 25px; border-radius: 12px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.04); transition: transform 0.3s; }
    .card:hover { transform: translateY(-5px); }
    .card-icon { font-size: 40px; color: var(--primary-green); margin-bottom: 20px; }
    .card-title { font-size: 16px; font-weight: 700; color: var(--text-dark); margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px; }
    .card-text { font-size: 13px; color: var(--text-muted); line-height: 1.5; }

    /* Grafik Section */
    .section-grafik {
        background: linear-gradient(180deg, #f0f9ff 0%, #e0f2fe 100%);
        padding: 4rem 1.5rem;
    }
    .grafik-card {
        background: #ffffff;
        border-radius: 1.5rem;
        border: 1px solid #bae6fd;
        box-shadow: 0 4px 24px rgba(14,165,233,0.08);
        padding: 2rem;
        max-width: 56rem;
        margin: 0 auto;
    }
    .grafik-search-wrap {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    .grafik-select {
        flex: 1;
        border: 1.5px solid #bae6fd;
        border-radius: 0.75rem;
        padding: 0.65rem 1rem;
        font-size: 0.95rem;
        color: #1e293b;
        outline: none;
        background: #f0f9ff;
        cursor: pointer;
    }
    .grafik-select:focus { border-color: #38bdf8; background: #fff; }
    .grafik-btn-cari {
        background: linear-gradient(135deg, #0ea5e9, #0284c7);
        color: white;
        border: none;
        border-radius: 0.75rem;
        padding: 0.65rem 1.4rem;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.1s;
        white-space: nowrap;
    }
    .grafik-btn-cari:hover { opacity: 0.9; }
    .grafik-btn-cari:disabled { opacity: 0.6; cursor: not-allowed; }
    .grafik-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.25rem;
        border-bottom: 1.5px solid #e0f2fe;
        padding-bottom: 0.75rem;
    }
    .grafik-tab {
        background: transparent;
        border: 1.5px solid #bae6fd;
        border-radius: 0.6rem;
        padding: 0.4rem 1.1rem;
        font-size: 0.85rem;
        cursor: pointer;
        color: #0369a1;
        font-weight: 500;
        transition: all 0.15s;
    }
    .grafik-tab.aktif { background: #0ea5e9; color: white; border-color: #0ea5e9; }
    .grafik-tab:hover:not(.aktif) { background: #e0f2fe; }
    .grafik-metrics {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }
    .grafik-metric {
        background: #f0f9ff;
        border: 1px solid #bae6fd;
        border-radius: 1rem;
        padding: 0.85rem 1rem;
        text-align: center;
    }
    .grafik-metric-label { font-size: 0.75rem; color: #64748b; margin-bottom: 0.25rem; }
    .grafik-metric-value { font-size: 1.3rem; font-weight: 700; color: #0369a1; }
    .grafik-metric-icon { font-size: 1.2rem; }
    .grafik-canvas-wrap { position: relative; width: 100%; height: 300px; }
    .grafik-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1rem;
        font-size: 0.78rem;
        color: #64748b;
    }
    .grafik-legend-item { display: flex; align-items: center; gap: 5px; }
    .grafik-legend-dot { width: 10px; height: 10px; border-radius: 2px; display: inline-block; }
    .grafik-status { text-align: center; padding: 2.5rem 0; color: #94a3b8; font-size: 0.9rem; }
    .grafik-error { color: #ef4444; }
    .grafik-spinner {
        display: inline-block;
        width: 22px; height: 22px;
        border: 3px solid #bae6fd;
        border-top-color: #0ea5e9;
        border-radius: 50%;
        animation: grafikspin 0.7s linear infinite;
        vertical-align: middle;
        margin-right: 8px;
    }
    @keyframes grafikspin { to { transform: rotate(360deg); } }
    .grafik-kota-label {
        font-size: 0.8rem;
        color: #0369a1;
        background: #e0f2fe;
        border-radius: 999px;
        padding: 0.2rem 0.85rem;
        display: inline-block;
        margin-bottom: 1rem;
        font-weight: 500;
    }

    /* PREDIKSI CUACA */
    .section-prediksi {
        background: #ffffff;
        padding: 4rem 1.5rem;
    }

    /* Tab Prediksi (7 Hari ke Depan / Bulan Depan) */
    .prediksi-tabs {
        display: flex;
        gap: 0;
        border-bottom: 1.5px solid #e2e8f0;
        margin-bottom: 1.5rem;
    }
    .prediksi-tab {
        background: transparent;
        border: none;
        padding: 0.75rem 1.5rem;
        font-size: 0.95rem;
        font-weight: 600;
        color: #64748b;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        margin-bottom: -1.5px;
        transition: color 0.2s, border-color 0.2s;
    }
    .prediksi-tab.aktif { color: #2563eb; border-bottom-color: #2563eb; }
    .prediksi-tab:hover:not(.aktif) { color: #334155; }

    /* Kartu ringkasan (kondisi minggu / bulan) */
    .ringkasan-card {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 1rem;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        display: flex;
        gap: 14px;
        align-items: flex-start;
    }
    .ringkasan-emoji { font-size: 1.8rem; line-height: 1; }
    .ringkasan-judul { font-weight: 700; color: #1e3a8a; font-size: 1rem; margin-bottom: 4px; }
    .ringkasan-sub { font-size: 0.85rem; color: #1e40af; line-height: 1.5; }

    /* List aktivitas per hari/minggu */
    .aktivitas-item {
        display: flex;
        gap: 12px;
        padding: 14px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .aktivitas-item:last-child { border-bottom: none; }
    .aktivitas-dot { width: 10px; height: 10px; border-radius: 50%; margin-top: 6px; flex-shrink: 0; }
    .dot-merah { background: #ef4444; }
    .dot-kuning { background: #f59e0b; }
    .dot-biru { background: #3b82f6; }
    .aktivitas-judul { font-weight: 700; color: #1e293b; font-size: 0.95rem; margin-bottom: 4px; }
    .aktivitas-desc { font-size: 0.85rem; color: #64748b; line-height: 1.5; }

    /* Kartu rekomendasi bulan depan */
    .bulan-rekom-card { border-radius: 1rem; padding: 1.25rem; margin-bottom: 1rem; border: 1px solid; }
    .bulan-rekom-hijau { background: #f0fdf4; border-color: #bbf7d0; }
    .bulan-rekom-merah { background: #fef2f2; border-color: #fecaca; }
    .bulan-rekom-kuning { background: #fffbeb; border-color: #fde68a; }
    .bulan-rekom-badge { display: inline-block; font-size: 0.7rem; font-weight: 700; padding: 3px 10px; border-radius: 999px; margin-bottom: 8px; }
    .badge-hijau { background: #bbf7d0; color: #166534; }
    .badge-merah { background: #fecaca; color: #991b1b; }
    .badge-kuning { background: #fde68a; color: #92400e; }
    .bulan-rekom-judul { font-weight: 700; font-size: 0.95rem; margin-bottom: 4px; color: #1e293b; }
    .bulan-rekom-desc { font-size: 0.85rem; line-height: 1.5; color: #475569; }

    /* Data Iklim Section */
    .section-iklim {
        background: #f4f6fa;
        padding: 4rem 1.5rem;
    }
    #tabelIklim table { width:100%; border-collapse:collapse; font-size:13px; }
    #tabelIklim th {
        background: #1d4ed8;
        color: white;
        padding: 10px;
        text-align: center;
        font-weight: 600;
    }
    #tabelIklim td {
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        text-align: center;
        color: #1e293b;
    }
    #tabelIklim tr:nth-child(even) { background: #f8fafc; }
    #tabelIklim tr:hover { background: #eff6ff; transition: background 0.2s; }

    /* LINK KABAR SEKITAR & RIWAYAT */
    .link-section {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 30px;
        padding: 20px;
        background: #fff;
        border-radius: 14px;
        border: 1px solid #e2e8e2;
        max-width: 56rem;
        margin-left: auto;
        margin-right: auto;
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
    .link-btn-green { background: #4caf50; color: #fff; }
    .link-btn-green:hover { background: #43a047; }
    .link-btn-blue { background: #2563eb; color: #fff; }
    .link-btn-blue:hover { background: #1d4ed8; }

    .footer {
    background: linear-gradient(160deg, #0c4a6e 0%, #075985 100%);
    border-top: 1px solid rgba(255,255,255,0.1);
    padding: 2rem 1.5rem;
    text-align: center;
    color: white;
    margin-top: auto;
    width: 100%;
}
    .max-w-4xl { max-width: 56rem; margin-left: auto; margin-right: auto; }
    .text-center { text-align: center; }
    .text-3xl { font-size: 1.875rem; }
    .font-bold { font-weight: 700; }
    .text-slate-800 { color: #1e293b; }
    .text-slate-500 { color: #64748b; }
    .mb-3 { margin-bottom: 0.75rem; }
    .mb-10 { margin-bottom: 2.5rem; }
    .mx-auto { margin-left: auto; margin-right: auto; }
    .text-sm { font-size: 0.875rem; }
    .bg-white { background-color: white; }
    .rounded-2xl { border-radius: 1rem; }
    .border { border-width: 1px; }
    .border-slate-200 { border-color: #e2e8f0; }
    .shadow-sm { box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05); }
    .p-6 { padding: 1.5rem; }
    .p-8 { padding: 2rem; }
    .overflow-x-auto { overflow-x: auto; }
    .text-gray-400 { color: #9ca3af; }
    .grid { display: grid; }
    .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
    .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .gap-3 { gap: 0.75rem; }
    .gap-4 { gap: 1rem; }
    .hidden { display: none; }
    .mt-6 { margin-top: 1.5rem; }
    .mb-2 { margin-bottom: 0.5rem; }
    .mb-4 { margin-bottom: 1rem; }
    .mb-6 { margin-bottom: 1.5rem; }
    .w-full { width: 100%; }
    .md\:col-span-1 { grid-column: span 1 / span 1; }
    .md\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .md\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    .items-end { align-items: flex-end; }
    .flex { display: flex; }
    .flex-1 { flex: 1 1 0%; }
    .justify-center { justify-content: center; }
    .rounded-xl { border-radius: 0.75rem; }
    .bg-indigo-600 { background-color: #4f46e5; }
    .hover\:bg-indigo-500:hover { background-color: #6366f1; }
    .text-white { color: white; }
    .font-semibold { font-weight: 600; }
    .px-4 { padding-left: 1rem; padding-right: 1rem; }
    .py-2\.5 { padding-top: 0.625rem; padding-bottom: 0.625rem; }
    .text-base { font-size: 1rem; }

    @media (max-width: 992px) {
        .features { grid-template-columns: repeat(2, 1fr); margin-top: -20px; }
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
        /* NAVBAR DROPDOWN - MUNCUL DARI ATAS KE BAWAH */
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
        .hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(6px, -6px); }
        .hero { padding-top: 80px; text-align: center; min-height: 40vh; }
        .hero-content { margin: 0 auto; }
        .hero-title { font-size: 28px; }
        .features { grid-template-columns: 1fr; margin-top: 20px; gap: 20px; }
        .grafik-card { padding: 1.25rem; }
        .grafik-canvas-wrap { height: 230px; }
        .md\:grid-cols-3 { grid-template-columns: 1fr; }
        .md\:grid-cols-4 { grid-template-columns: repeat(2, 1fr); }
        .md\:col-span-1 { grid-column: span 1; }
        .section-prediksi { padding: 2rem 1rem; }
        .p-8 { padding: 1rem; }
        .prediksi-tab { padding: 0.65rem 1rem; font-size: 0.85rem; }
        .link-section { flex-direction: column; align-items: center; }
        .link-btn { width: 100%; justify-content: center; }
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
        <li class="nav-item active"><a href="/dashboard">Beranda</a></li>
        <li class="nav-item"><a href="/cekpenyakit">Identifikasi Penyakit</a></li>
        <li class="nav-item"><a href="/infopenyakit">Info Penyakit</a></li>
        <li class="nav-item"><a href="/hasildiagnosa">Hasil Diagnosa</a></li>
    </ul>

        <div class="user-profile">
            <span class="user-name">Halo, <strong>{{ $namaUser }}</strong></span>
            <button class="btn-logout" onclick="window.location.href='/logout'">Logout</button>
        </div>

        <div class="hamburger" id="hamburgerBtn">
            <span></span><span></span><span></span>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h2 class="hero-title">DETEKSI DINI & KENDALIKAN PENYAKIT TANAMAN ANDA</h2>
            <p class="hero-description">Platform Digital Pintar untuk Diagnosis Akurat, Penanganan Efektif, dan Peningkatan Hasil Panen Petani Indonesia.</p>
            <!-- TOMBOL DIUBAH - SEKARANG MENUJU /cekpenyakit -->
            <a href="/cekpenyakit" class="btn-cta">
                <i class="fa-solid fa-camera"></i> Mulai Identifikasi Sekarang
            </a>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="features">
        <div class="card">
            <div class="card-icon"><i class="fa-solid fa-leaf"></i></div>
            <h3 class="card-title">Identifikasi Penyakit</h3>
            <p class="card-text">Unggah foto tanaman Anda untuk diagnosis cepat</p>
        </div>
        <div class="card">
            <div class="card-icon"><i class="fa-solid fa-book-open-reader"></i></div>
            <h3 class="card-title">Info Penyakit</h3>
            <p class="card-text">Temukan informasi lainnya tentang penyakit tanaman, gejala, dan cara penanganan</p>
        </div>
        <div class="card">
            <div class="card-icon"><i class="fa-solid fa-cloud-sun-rain"></i></div>
            <h3 class="card-title">Cek Prediksi Cuaca</h3>
            <p class="card-text">Cek prediksi cuaca lokal di Wilayah Jawa Timur</p>
        </div>
    </section>

    <!-- GRAFIK CUACA -->
    <section id="grafik" class="section-grafik">
        <div class="max-w-4xl">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-slate-800 mb-3">Grafik Cuaca Jawa Timur</h2>
                <p class="text-slate-500 max-w-xl mx-auto text-sm">
                    Pilih kota di Jawa Timur untuk melihat grafik cuaca 5 hari ke depan
                </p>
            </div>

            <div class="grafik-card">
                <div class="grafik-search-wrap">
                    <select id="grafikSelectKota" class="grafik-select">
                        <option value="">-- Pilih Kota --</option>
                        @foreach($daftarKota as $kota)
                            <option value="{{ $kota['value'] }}">{{ $kota['label'] }}</option>
                        @endforeach
                    </select>
                    <button class="grafik-btn-cari" id="grafikBtnCari" onclick="tampilkanGrafik()">
                        📊 Tampilkan
                    </button>
                </div>

                <div id="grafikKonten">
                    <div class="grafik-status">☁️ Pilih kota untuk menampilkan grafik cuaca</div>
                </div>
            </div>
        </div>
    </section>

    <!-- DATA IKLIM BPS -->
    <section id="iklim" class="section-iklim">
        <div class="max-w-4xl">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-slate-800 mb-3">Data Iklim Provinsi Jawa Timur</h2>
            </div>
            <div id="tabelIklim" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 overflow-x-auto">
                <p class="text-center text-gray-400 text-sm">Memuat data...</p>
            </div>
        </div>
    </section>

<!-- PREDIKSI CUACA -->
<section id="prediksicuaca" class="section-prediksi">
    <div class="max-w-4xl mx-auto">

        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-slate-800 mb-3">🔍 Prediksi Cuaca</h2>
            <p class="text-slate-500 max-w-xl mx-auto text-sm">
                Masukkan daerah dan tanggal untuk melihat hasil prediksi cuaca
            </p>
        </div>

        <div class="max-w-xl mx-auto bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-8">
            <h3 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2">Isi Data Prediksi</h3>

            <div class="flex flex-col gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">📍 Daerah / Kota</label>
                    <select id="inputDaerah" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none cursor-pointer">
                        <option value="">-- Pilih Daerah --</option>
                        @foreach($daftarKota as $kota)
                            <option value="{{ $kota['value'] }}">{{ $kota['label'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">📅 Tanggal Prediksi</label>
                    <input type="hidden" id="inputTanggal" />
                    <input id="inputTanggal_display" type="text" placeholder="Pilih Tanggal" readonly class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer bg-white" />
                </div>

                <button onclick="cekPrediksi()" class="w-full flex justify-center items-center rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white hover:bg-blue-700 transition-colors mt-2">
                    🔍 Cek Prediksi
                </button>
            </div>

            <p id="pesanError" class="text-red-500 text-sm text-center hidden mt-3">⚠️ Mohon isi daerah dan tanggal terlebih dahulu.</p>
        </div>

        <!-- HASIL PREDIKSI -->
        <div id="hasilPrediksi" class="hidden">

            <div class="bg-gradient-to-r from-blue-500 to-sky-400 text-white rounded-2xl p-6 mb-6 shadow-md flex justify-between items-center">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1" id="hasilLokasi">📍 Jember, Jawa Timur</p>
                    <p class="text-blue-100 text-xs mb-4" id="hasilTanggal">Sabtu, 20 Juni 2026</p>
                    <div class="flex items-end gap-3">
                        <span id="hasilSuhu" class="text-6xl font-bold">29°</span>
                        <span id="hasilKondisi" class="text-lg font-semibold mb-1">hujan rintik-rintik</span>
                    </div>
                </div>
                <div id="hasilEmoji" class="text-7xl drop-shadow-md">
                    ⛅
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm flex flex-col justify-center items-center">
                    <p class="text-xs text-gray-500 mb-1">💧 Kelembaban</p>
                    <p id="hasilLembab" class="text-xl font-bold text-slate-800">82%</p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm flex flex-col justify-center items-center">
                    <p class="text-xs text-gray-500 mb-1">💨 Kec. Angin</p>
                    <p id="hasilAngin" class="text-xl font-bold text-slate-800">5 km/j</p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm flex flex-col justify-center items-center">
                    <p class="text-xs text-gray-500 mb-1">🌧️ Peluang Hujan</p>
                    <p id="hasilHujan" class="text-xl font-bold text-slate-800">28%</p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm flex flex-col justify-center items-center">
                    <p class="text-xs text-gray-500 mb-1">🌡️ Tekanan Udara</p>
                    <p id="hasilUV" class="text-xl font-bold text-slate-800">1013 hPa</p>
                </div>
            </div>

            <!-- TAB 7 HARI / BULAN DEPAN -->
            <div class="prediksi-tabs">
                <button class="prediksi-tab aktif" data-tab="minggu" onclick="gantiPrediksiTab('minggu', this)">7 Hari ke Depan</button>
                <button class="prediksi-tab" data-tab="bulan" onclick="gantiPrediksiTab('bulan', this)">Bulan Depan</button>
            </div>

            <div id="tabMinggu">
                <div id="ringkasanMinggu" class="ringkasan-card">
                    <div class="ringkasan-emoji">☁️</div>
                    <div>
                        <div class="ringkasan-judul">Memuat ringkasan minggu...</div>
                        <div class="ringkasan-sub"></div>
                    </div>
                </div>

                <h3 class="text-slate-500 font-bold text-sm uppercase tracking-wider mb-2 border-b pb-2">Aktivitas Petani Minggu Ini</h3>
                <div id="rekAktivitasMinggu"></div>
            </div>

            <div id="tabBulan" class="hidden">
                <div id="ringkasanBulan" class="ringkasan-card">
                    <div class="ringkasan-emoji">📅</div>
                    <div>
                        <div class="ringkasan-judul">Memuat prediksi bulan depan...</div>
                        <div class="ringkasan-sub"></div>
                    </div>
                </div>

                <div id="rekomendasiBulan" class="mb-6"></div>

                <h3 class="text-slate-500 font-bold text-sm uppercase tracking-wider mb-2 border-b pb-2">Aktivitas Petani Bulan Depan</h3>
                <div id="aktivitasBulan"></div>
            </div>

        </div>
        <!-- END hasilPrediksi -->

    </div>
</section>

<!-- ========================================== -->
<!-- LINK KABAR SEKITAR & RIWAYAT PREDIKSI -->
<!-- ========================================== -->
<div id="linkSetelahPrediksi" style="display: none; max-width: 56rem; margin: 0 auto; padding: 0 1.5rem 2rem;">
    <div style="display:flex; gap:16px; justify-content:center; flex-wrap:wrap; padding:20px; background:#fff; border-radius:14px; border:1px solid #e2e8e2;">
        <a href="/kabarsekitar" style="padding:12px 32px; background:#4caf50; color:#fff; border-radius:10px; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:8px; transition:all 0.3s;">
            <i class="fa-solid fa-comment"></i> Kabar Sekitar
        </a>
        <a href="/riwayatprediksi" style="padding:12px 32px; background:#2563eb; color:#fff; border-radius:10px; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:8px; transition:all 0.3s;">
            <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Prediksi
        </a>
    </div>
    <p style="text-align:center; font-size:13px; color:#8fa89a; margin-top:12px;">
        Bagikan kabar cuaca atau lihat riwayat prediksi dari pengguna lain
    </p>
</div>

<!-- ========================================== -->
<!-- FOOTER - SELALU ADA -->
<!-- ========================================== -->
<footer class="footer">
    <p>&copy; {{ date('Y') }} Website Agro Clima Care (ACC). Semua Hak Dilindungi.</p>
</footer>

    <script>
// ==========================================
// HAMBURGER MENU - DROPDOWN DARI ATAS
// ==========================================
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

// Tutup menu saat scroll
window.addEventListener('scroll', () => {
    if (navMenu.classList.contains('active')) {
        hamburgerBtn.classList.remove('active');
        navMenu.classList.remove('active');
    }
});

// ==========================================
// GRAFIK CUACA
// ==========================================
let grafikChart = null;
let grafikDataCache = null;
let grafikNamaKota = '';

function tampilkanGrafik() {
    const select = document.getElementById('grafikSelectKota');
    const kota = select.value;

    if (!kota) {
        document.getElementById('grafikKonten').innerHTML =
            '<div class="grafik-status grafik-error">⚠️ Pilih kota terlebih dahulu.</div>';
        return;
    }

    grafikNamaKota = kota;

    const btn = document.getElementById('grafikBtnCari');
    btn.disabled = true;
    btn.textContent = 'Memuat...';

    document.getElementById('grafikKonten').innerHTML =
        '<div class="grafik-status"><span class="grafik-spinner"></span> Mengambil data cuaca <b>' + kota + '</b>...</div>';

    fetch('/api/cuaca?kota=' + encodeURIComponent(kota))
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                document.getElementById('grafikKonten').innerHTML =
                    '<div class="grafik-status grafik-error">❌ ' + data.error + '</div>';
                return;
            }

            const processed = processWeatherData(data);
            grafikDataCache = processed;
            renderGrafikKonten(processed);
        })
        .catch(err => {
            document.getElementById('grafikKonten').innerHTML =
                '<div class="grafik-status grafik-error">❌ Gagal mengambil data: ' + err.message + '</div>';
        })
        .finally(() => {
            btn.disabled = false;
            btn.textContent = '📊 Tampilkan';
        });
}

function processWeatherData(data) {
    const labels = [];
    const suhuMax = [];
    const suhuMin = [];
    const hujan = [];
    const kelembaban = [];

    const dailyData = {};
    data.list.forEach(item => {
        const date = item.dt_txt.split(' ')[0];
        if (!dailyData[date]) {
            dailyData[date] = {
                temps: [],
                humidity: [],
                rain: 0
            };
        }
        dailyData[date].temps.push(item.main.temp);
        dailyData[date].humidity.push(item.main.humidity);
        if (item.rain && item.rain['3h']) {
            dailyData[date].rain += item.rain['3h'];
        }
    });

    const dates = Object.keys(dailyData).slice(0, 5);
    dates.forEach(date => {
        const d = new Date(date);
        const hari = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'][d.getDay()];
        const tgl = d.getDate();
        const bln = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'][d.getMonth()];
        labels.push(hari + ' ' + tgl + ' ' + bln);

        const temps = dailyData[date].temps;
        suhuMax.push(Math.round(Math.max(...temps)));
        suhuMin.push(Math.round(Math.min(...temps)));
        hujan.push(Math.round(dailyData[date].rain * 10) / 10);
        kelembaban.push(Math.round(dailyData[date].humidity.reduce((a, b) => a + b, 0) / dailyData[date].humidity.length));
    });

    return { labels, suhuMax, suhuMin, hujan, kelembaban };
}

function renderGrafikKonten(data) {
    const max = Math.round(data.suhuMax.reduce((a, b) => a + b, 0) / data.suhuMax.length);
    const min = Math.round(data.suhuMin.reduce((a, b) => a + b, 0) / data.suhuMin.length);
    const hujan = data.hujan.reduce((a, b) => a + b, 0).toFixed(1);
    const rh = Math.round(data.kelembaban.reduce((a, b) => a + b, 0) / data.kelembaban.length);

    document.getElementById('grafikKonten').innerHTML = `
        <span class="grafik-kota-label">📍 ${grafikNamaKota}, Jawa Timur</span>
        <div class="grafik-metrics" id="grafikMetrics">
            <div class="grafik-metric">
                <div class="grafik-metric-icon">🌡️</div>
                <div class="grafik-metric-label">Suhu Maks</div>
                <div class="grafik-metric-value">${max}°C</div>
            </div>
            <div class="grafik-metric">
                <div class="grafik-metric-icon">🌡️</div>
                <div class="grafik-metric-label">Suhu Min</div>
                <div class="grafik-metric-value">${min}°C</div>
            </div>
            <div class="grafik-metric">
                <div class="grafik-metric-icon">🌧️</div>
                <div class="grafik-metric-label">Total Hujan</div>
                <div class="grafik-metric-value">${hujan} mm</div>
            </div>
            <div class="grafik-metric">
                <div class="grafik-metric-icon">💧</div>
                <div class="grafik-metric-label">Kelembaban</div>
                <div class="grafik-metric-value">${rh}%</div>
            </div>
        </div>
        <div class="grafik-tabs">
            <button class="grafik-tab aktif" onclick="gantiTab('harian', this)">Harian</button>
        </div>
        <div class="grafik-canvas-wrap">
            <canvas id="grafikCanvas"></canvas>
        </div>
        <div class="grafik-legend">
            <span class="grafik-legend-item">
                <span class="grafik-legend-dot" style="background:#0ea5e9;"></span> Suhu Maks (°C)
            </span>
            <span class="grafik-legend-item">
                <span class="grafik-legend-dot" style="background:#38bdf8;opacity:.7;"></span> Suhu Min (°C)
            </span>
            <span class="grafik-legend-item">
                <span class="grafik-legend-dot" style="background:#1d9e75;"></span> Curah Hujan (mm)
            </span>
            <span class="grafik-legend-item">
                <span class="grafik-legend-dot" style="background:#f59e0b;"></span> Kelembaban (%)
            </span>
        </div>
        <p style="font-size:0.72rem;color:#94a3b8;margin-top:1rem;text-align:center;">
            Sumber: OpenWeatherMap · Data 5 hari ke depan
        </p>
    `;
    renderChart(data);
}

function renderChart(data) {
    const ctx = document.getElementById('grafikCanvas');
    if (!ctx) return;
    if (grafikChart) { grafikChart.destroy(); grafikChart = null; }

    grafikChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [
                {
                    label: 'Suhu Maks (°C)',
                    data: data.suhuMax,
                    type: 'line',
                    borderColor: '#0ea5e9',
                    backgroundColor: 'rgba(14,165,233,0.10)',
                    pointBackgroundColor: '#0ea5e9',
                    borderWidth: 2,
                    pointRadius: 4,
                    tension: 0.35,
                    yAxisID: 'yTemp',
                    fill: false,
                    order: 1
                },
                {
                    label: 'Suhu Min (°C)',
                    data: data.suhuMin,
                    type: 'line',
                    borderColor: '#38bdf8',
                    backgroundColor: 'rgba(56,189,248,0.08)',
                    pointBackgroundColor: '#38bdf8',
                    borderWidth: 1.5,
                    pointRadius: 3,
                    borderDash: [4,3],
                    tension: 0.35,
                    yAxisID: 'yTemp',
                    fill: false,
                    order: 1
                },
                {
                    label: 'Curah Hujan (mm)',
                    data: data.hujan,
                    type: 'bar',
                    backgroundColor: 'rgba(29,158,117,0.65)',
                    borderColor: '#1d9e75',
                    borderWidth: 0,
                    borderRadius: 4,
                    yAxisID: 'yHujan',
                    order: 2
                },
                {
                    label: 'Kelembaban (%)',
                    data: data.kelembaban,
                    type: 'line',
                    borderColor: '#f59e0b',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#f59e0b',
                    borderWidth: 1.5,
                    borderDash: [3,3],
                    pointRadius: 3,
                    tension: 0.3,
                    yAxisID: 'yTemp',
                    fill: false,
                    order: 0
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            const label = ctx.dataset.label || '';
                            if (label.includes('Hujan')) return ' ' + label + ': ' + ctx.parsed.y + ' mm';
                            if (label.includes('Kelembaban')) return ' ' + label + ': ' + ctx.parsed.y + '%';
                            return ' ' + label + ': ' + ctx.parsed.y + '°C';
                        }
                    }
                }
            },
            scales: {
                yTemp: {
                    type: 'linear', position: 'left', min: 0, max: 100,
                    ticks: { font: { size: 11 }, color: '#94a3b8', callback: v => v <= 50 ? v + '°' : v + '%' },
                    grid: { color: 'rgba(148,163,184,0.15)' }
                },
                yHujan: {
                    type: 'linear', position: 'right', min: 0,
                    ticks: { font: { size: 11 }, color: '#1d9e75', callback: v => v + ' mm' },
                    grid: { drawOnChartArea: false }
                },
                x: {
                    ticks: { font: { size: 11 }, color: '#94a3b8', autoSkip: false, maxRotation: 45 },
                    grid: { color: 'rgba(148,163,184,0.08)' }
                }
            }
        }
    });
}

function gantiTab(tab, el) {
    document.querySelectorAll('.grafik-tab').forEach(b => b.classList.remove('aktif'));
    el.classList.add('aktif');
}

// ==========================================
// LOAD DATA IKLIM
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    fetch('/api/iklim')
        .then(res => res.json())
        .then(data => {
            if (data.status === 'OK') {
                document.getElementById('tabelIklim').innerHTML = data.tabel;
            } else {
                document.getElementById('tabelIklim').innerHTML =
                    '<p class="text-center text-red-400">❌ ' + (data.message || 'Gagal memuat data') + '</p>';
            }
        })
        .catch(err => {
            document.getElementById('tabelIklim').innerHTML =
                '<p class="text-center text-red-400">❌ Terjadi kesalahan: ' + err.message + '</p>';
        });
});

// ==========================================
// FLATPICKR - TANGGAL PREDIKSI
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#inputTanggal_display", {
        dateFormat: "d/m/Y",
        disableMobile: true,
        onChange: function(selectedDates, dateStr, instance) {
            if (selectedDates.length > 0) {
                const d = selectedDates[0];
                const yyyy = d.getFullYear();
                const mm = String(d.getMonth() + 1).padStart(2, '0');
                const dd = String(d.getDate()).padStart(2, '0');
                document.getElementById('inputTanggal').value = `${yyyy}-${mm}-${dd}`;
            }
        }
    });
});

// ==========================================
// CEK PREDIKSI
// ==========================================
function cekPrediksi() {
    const kota = document.getElementById('inputDaerah').value;
    const tanggal = document.getElementById('inputTanggal').value;

    if (!kota || !tanggal) {
        document.getElementById('pesanError').classList.remove('hidden');
        return;
    }
    document.getElementById('pesanError').classList.add('hidden');

    document.getElementById('hasilPrediksi').classList.remove('hidden');
    document.getElementById('linkSetelahPrediksi').style.display = 'block';
    
    document.getElementById('hasilLokasi').textContent = '📍 ' + kota + ', Jawa Timur';
    document.getElementById('hasilTanggal').textContent = 'Memuat data...';
    document.getElementById('hasilSuhu').textContent = '--°';
    document.getElementById('hasilKondisi').textContent = 'Memuat...';
    document.getElementById('hasilLembab').textContent = '--%';
    document.getElementById('hasilAngin').textContent = '-- km/j';
    document.getElementById('hasilHujan').textContent = '-- mm';
    document.getElementById('hasilUV').textContent = '-- hPa';

    fetch('/api/cuaca?kota=' + encodeURIComponent(kota))
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                document.getElementById('hasilKondisi').textContent = 'Error: ' + data.error;
                return;
            }

            const targetDate = new Date(tanggal);
            const targetDateStr = targetDate.toISOString().split('T')[0];

            let foundData = null;
            let isApproximate = false;
            
            // Cari exact match
            for (let i = 0; i < data.list.length; i++) {
                const itemDate = data.list[i].dt_txt.split(' ')[0];
                if (itemDate === targetDateStr) {
                    foundData = data.list[i];
                    break;
                }
            }

            // Cari terdekat jika tidak ada exact match
            if (!foundData) {
                isApproximate = true;
                let closestDiff = Infinity;
                let closestIndex = -1;
                
                for (let i = 0; i < data.list.length; i++) {
                    const itemDate = new Date(data.list[i].dt_txt);
                    const diff = Math.abs(itemDate - targetDate);
                    if (diff < closestDiff) {
                        closestDiff = diff;
                        closestIndex = i;
                    }
                }
                
                if (closestIndex !== -1) {
                    foundData = data.list[closestIndex];
                }
            }

            if (foundData) {
                const temp = Math.round(foundData.main.temp);
                const humidity = foundData.main.humidity;
                const windSpeed = Math.round(foundData.wind.speed * 3.6);
                const pressure = foundData.main.pressure;
                const condition = foundData.weather[0].description;
                const icon = foundData.weather[0].icon;
                const rain = foundData.rain ? foundData.rain['3h'] || 0 : 0;

                document.getElementById('hasilSuhu').textContent = temp + '°';
                document.getElementById('hasilKondisi').textContent = condition;
                document.getElementById('hasilLembab').textContent = humidity + '%';
                document.getElementById('hasilAngin').textContent = windSpeed + ' km/j';
                document.getElementById('hasilHujan').textContent = (rain > 0 ? Math.round(rain * 10) / 10 : 0) + ' mm';
                document.getElementById('hasilUV').textContent = pressure + ' hPa';

                const emojiMap = {
                    '01d': '☀️', '01n': '🌙',
                    '02d': '⛅', '02n': '☁️',
                    '03d': '☁️', '03n': '☁️',
                    '04d': '☁️', '04n': '☁️',
                    '09d': '🌧️', '09n': '🌧️',
                    '10d': '🌦️', '10n': '🌧️',
                    '11d': '⛈️', '11n': '⛈️',
                    '13d': '❄️', '13n': '❄️',
                    '50d': '🌫️', '50n': '🌫️'
                };
                document.getElementById('hasilEmoji').textContent = emojiMap[icon] || '⛅';

                const d = new Date(foundData.dt_txt);
                const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][d.getDay()];
                const tgl = d.getDate();
                const bln = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][d.getMonth()];
                const thn = d.getFullYear();
                
                let tanggalDisplay = hari + ', ' + tgl + ' ' + bln + ' ' + thn;
                if (isApproximate) {
                    tanggalDisplay += ' 🔄 (Data terdekat)';
                }
                document.getElementById('hasilTanggal').textContent = tanggalDisplay;

                // SIMPAN RIWAYAT
                fetch('/api/simpan-riwayat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        kota: kota,
                        suhu: temp,
                        kondisi: condition,
                        icon: icon,
                        tanggal_prediksi: tanggal
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Riwayat tersimpan:', data);
                })
                .catch(error => {
                    console.error('Gagal simpan riwayat:', error);
                });

            } else {
                document.getElementById('hasilKondisi').textContent = '⚠️ Tidak ada data cuaca untuk tanggal ini';
                document.getElementById('hasilSuhu').textContent = '--°';
                document.getElementById('hasilLembab').textContent = '--%';
                document.getElementById('hasilAngin').textContent = '-- km/j';
                document.getElementById('hasilHujan').textContent = '-- mm';
                document.getElementById('hasilUV').textContent = '-- hPa';
                document.getElementById('hasilEmoji').textContent = '❓';
                
                const ringkasanMinggu = document.getElementById('ringkasanMinggu');
                ringkasanMinggu.innerHTML = `
                    <div class="ringkasan-emoji">📡</div>
                    <div>
                        <div class="ringkasan-judul">Data Cuaca Real Time</div>
                        <div class="ringkasan-sub">Data yang ditampilkan adalah data cuaca real time dari OpenWeatherMap untuk 5 hari ke depan. Silakan pilih tanggal lain.</div>
                    </div>
                `;
                document.getElementById('rekAktivitasMinggu').innerHTML = '';
                return;
            }

            const dailyArr = aggregateDaily(data.list);
            generateMingguan(dailyArr, kota);
            generateBulanan(dailyArr, kota);
        })
        .catch(err => {
            document.getElementById('hasilKondisi').textContent = 'Error: ' + err.message;
        });
}

// ==========================================
// FUNGSI PEMBANTU
// ==========================================
function aggregateDaily(list) {
    const grouped = {};
    list.forEach(item => {
        const date = item.dt_txt.split(' ')[0];
        if (!grouped[date]) {
            grouped[date] = { temps: [], humid: [], rain: 0, conditions: [] };
        }
        grouped[date].temps.push(item.main.temp);
        grouped[date].humid.push(item.main.humidity);
        if (item.rain && item.rain['3h']) grouped[date].rain += item.rain['3h'];
        grouped[date].conditions.push(item.weather[0].main);
    });

    const dates = Object.keys(grouped).slice(0, 5);
    return dates.map(date => {
        const g = grouped[date];
        const tempAvg = Math.round(g.temps.reduce((a, b) => a + b, 0) / g.temps.length);
        const humidAvg = Math.round(g.humid.reduce((a, b) => a + b, 0) / g.humid.length);
        const rainTotal = Math.round(g.rain * 10) / 10;

        const condCounts = {};
        g.conditions.forEach(c => condCounts[c] = (condCounts[c] || 0) + 1);
        const condDominant = Object.keys(condCounts).reduce((a, b) => condCounts[a] >= condCounts[b] ? a : b);

        return { date, tempAvg, humidAvg, rainTotal, condDominant };
    });
}

function namaHari(dateStr) {
    const d = new Date(dateStr);
    return ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][d.getDay()];
}

function generateMingguan(dailyArr, kota) {
    const hujanDays = dailyArr.filter(d => d.rainTotal > 0 || d.condDominant === 'Rain' || d.condDominant === 'Thunderstorm').length;
    const avgHumid = Math.round(dailyArr.reduce((a, b) => a + b.humidAvg, 0) / dailyArr.length);
    const avgTemp = Math.round(dailyArr.reduce((a, b) => a + b.tempAvg, 0) / dailyArr.length);
    const isMusimHujan = hujanDays >= 3;

    const ringkasan = document.getElementById('ringkasanMinggu');
    if (isMusimHujan) {
        ringkasan.innerHTML = `
            <div class="ringkasan-emoji">🌧️</div>
            <div>
                <div class="ringkasan-judul">Tunda penanaman bibit baru</div>
                <div class="ringkasan-sub">Hujan diperkirakan turun ${hujanDays} dari ${dailyArr.length} hari ke depan di ${kota}. Tunda penanaman hingga cuaca lebih stabil. Manfaatkan waktu ini untuk menyiapkan dan mengolah lahan.</div>
            </div>`;
    } else {
        ringkasan.innerHTML = `
            <div class="ringkasan-emoji">☀️</div>
            <div>
                <div class="ringkasan-judul">Kondisi mendukung aktivitas tanam</div>
                <div class="ringkasan-sub">Cuaca di ${kota} relatif stabil, suhu rata-rata ${avgTemp}°C dan kelembaban ${avgHumid}%. Manfaatkan minggu ini untuk menanam, memupuk, dan merawat tanaman.</div>
            </div>`;
    }

    const cont = document.getElementById('rekAktivitasMinggu');
    let html = '';
    let prevHujan = false;

    dailyArr.forEach((d, i) => {
        const hari = namaHari(d.date);
        const hujanHariIni = d.rainTotal > 1 || d.condDominant === 'Rain' || d.condDominant === 'Thunderstorm';
        let dot, judul, desc;

        if (hujanHariIni && d.rainTotal > 5) {
            dot = 'dot-merah';
            judul = `${hari}: Pantau drainase lahan`;
            desc = `Hujan lebat diperkirakan (${d.rainTotal} mm). Jangan keluar lahan saat hujan deras. Pastikan saluran air tidak tersumbat agar lahan tidak tergenang.`;
        } else if (hujanHariIni) {
            dot = 'dot-merah';
            judul = `${hari}: Periksa kondisi tanaman`;
            desc = `Setelah hujan, periksa apakah ada tanaman roboh atau akar terendam. Tegakkan kembali tanaman yang miring.`;
        } else if (d.humidAvg > 75) {
            dot = 'dot-kuning';
            judul = `${hari}: Inspeksi hama & jamur`;
            desc = `Kelembaban ${d.humidAvg}% meningkatkan risiko jamur dan wereng. Periksa bagian bawah daun, semprot fungisida organik jika ada bercak.`;
        } else if (prevHujan) {
            dot = 'dot-biru';
            judul = `${hari}: Kurangi atau tunda penyiraman`;
            desc = `Hujan sudah cukup membasahi tanah. Tunda penyiraman hari ini. Cek kelembaban tanah sebelum memutuskan siram atau tidak.`;
        } else {
            dot = 'dot-biru';
            judul = `${hari}: Penyiraman & perawatan rutin`;
            desc = `Suhu ${d.tempAvg}°C dan kelembaban ${d.humidAvg}% mendukung penyiraman dan pemupukan rutin pada pagi atau sore hari.`;
        }

        if (i === dailyArr.length - 1 && isMusimHujan) {
            dot = 'dot-biru';
            judul = `${hari}: Perkuat drainase & pematang`;
            desc = `Manfaatkan jeda hujan untuk bersihkan saluran air dan perkuat pematang sawah agar lahan tidak kebanjiran minggu depan.`;
        }

        prevHujan = hujanHariIni;

        html += `
            <div class="aktivitas-item">
                <span class="aktivitas-dot ${dot}"></span>
                <div>
                    <div class="aktivitas-judul">${judul}</div>
                    <div class="aktivitas-desc">${desc}</div>
                </div>
            </div>`;
    });

    cont.innerHTML = html;
}

function generateBulanan(dailyArr, kota) {
    const avgTemp = Math.round(dailyArr.reduce((a, b) => a + b.tempAvg, 0) / dailyArr.length);
    const avgHumid = Math.round(dailyArr.reduce((a, b) => a + b.humidAvg, 0) / dailyArr.length);
    const hujanDays = dailyArr.filter(d => d.rainTotal > 0 || d.condDominant === 'Rain' || d.condDominant === 'Thunderstorm').length;
    const isMusimHujan = hujanDays >= 3;

    const now = new Date();
    const bulanDepan = new Date(now.getFullYear(), now.getMonth() + 1, 1);
    const namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][bulanDepan.getMonth()];

    const ringkasan = document.getElementById('ringkasanBulan');
    const rekomendasi = document.getElementById('rekomendasiBulan');
    const aktivitas = document.getElementById('aktivitasBulan');

    if (isMusimHujan) {
        ringkasan.innerHTML = `
            <div class="ringkasan-emoji">🌦️</div>
            <div>
                <div class="ringkasan-judul">Prediksi ${namaBulan}: Musim hujan, waspadai banjir lahan</div>
                <div class="ringkasan-sub">Hujan masih sering · Drainase harus siap (estimasi dari rata-rata 5 hari terakhir di ${kota})</div>
            </div>`;

        rekomendasi.innerHTML = `
            <div class="bulan-rekom-card bulan-rekom-hijau">
                <span class="bulan-rekom-badge badge-hijau">Tanam</span>
                <div class="bulan-rekom-judul">Pilih tanaman tahan air</div>
                <div class="bulan-rekom-desc">Kondisi basah cocok untuk padi sawah. Hindari tanaman yang mudah busuk akar. Pastikan drainase lahan berjalan baik sebelum tanam.</div>
            </div>
            <div class="bulan-rekom-card bulan-rekom-merah">
                <span class="bulan-rekom-badge badge-merah">Antisipasi</span>
                <div class="bulan-rekom-judul">Perkuat drainase & pematang sawah</div>
                <div class="bulan-rekom-desc">Hujan masih sering terjadi. Bersihkan saluran air, perkuat pematang agar lahan tidak tergenang. Lakukan minggu ini sebelum hujan semakin lebat.</div>
            </div>
            <div class="bulan-rekom-card bulan-rekom-kuning">
                <span class="bulan-rekom-badge badge-kuning">Irigasi</span>
                <div class="bulan-rekom-judul">Kurangi irigasi, manfaatkan air hujan</div>
                <div class="bulan-rekom-desc">Air hujan sudah cukup. Kurangi penggunaan pompa. Fokus pada pengelolaan air agar tidak berlebih dan merusak akar tanaman.</div>
            </div>`;

        aktivitas.innerHTML = `
            <div class="aktivitas-item"><span class="aktivitas-dot dot-merah"></span><div><div class="aktivitas-judul">Minggu 1: Persiapan drainase</div><div class="aktivitas-desc">Bersihkan dan perbaiki saluran air sebelum intensitas hujan meningkat.</div></div></div>
            <div class="aktivitas-item"><span class="aktivitas-dot dot-kuning"></span><div><div class="aktivitas-judul">Minggu 2: Pantau risiko hama & jamur</div><div class="aktivitas-desc">Kelembaban tinggi (rata-rata ${avgHumid}%) meningkatkan risiko penyakit tanaman.</div></div></div>
            <div class="aktivitas-item"><span class="aktivitas-dot dot-biru"></span><div><div class="aktivitas-judul">Minggu 3: Evaluasi kondisi lahan</div><div class="aktivitas-desc">Periksa tanaman yang terdampak hujan dan lakukan penyulaman jika perlu.</div></div></div>
            <div class="aktivitas-item"><span class="aktivitas-dot dot-biru"></span><div><div class="aktivitas-judul">Minggu 4: Persiapan musim berikutnya</div><div class="aktivitas-desc">Mulai rencanakan pola tanam untuk bulan setelahnya berdasarkan tren cuaca.</div></div></div>`;
    } else {
        ringkasan.innerHTML = `
            <div class="ringkasan-emoji">☀️</div>
            <div>
                <div class="ringkasan-judul">Prediksi ${namaBulan}: Cuaca cenderung kering & stabil</div>
                <div class="ringkasan-sub">Suhu rata-rata ${avgTemp}°C · Kelembaban ${avgHumid}% (estimasi dari rata-rata 5 hari terakhir di ${kota})</div>
            </div>`;

        rekomendasi.innerHTML = `
            <div class="bulan-rekom-card bulan-rekom-hijau">
                <span class="bulan-rekom-badge badge-hijau">Tanam</span>
                <div class="bulan-rekom-judul">Waktu baik untuk menanam & memupuk</div>
                <div class="bulan-rekom-desc">Kondisi kering dan stabil mendukung pertumbuhan bibit serta penyerapan pupuk daun yang optimal.</div>
            </div>
            <div class="bulan-rekom-card bulan-rekom-kuning">
                <span class="bulan-rekom-badge badge-kuning">Irigasi</span>
                <div class="bulan-rekom-judul">Tingkatkan frekuensi irigasi</div>
                <div class="bulan-rekom-desc">Curah hujan minim, pastikan kebutuhan air tanaman tetap tercukupi terutama saat siang hari.</div>
            </div>
            <div class="bulan-rekom-card bulan-rekom-merah">
                <span class="bulan-rekom-badge badge-merah">Antisipasi</span>
                <div class="bulan-rekom-judul">Waspada kekeringan lahan</div>
                <div class="bulan-rekom-desc">Pantau kelembaban tanah secara berkala dan siapkan cadangan air jika musim kering berlanjut.</div>
            </div>`;

        aktivitas.innerHTML = `
            <div class="aktivitas-item"><span class="aktivitas-dot dot-biru"></span><div><div class="aktivitas-judul">Minggu 1: Penanaman & pemupukan</div><div class="aktivitas-desc">Manfaatkan cuaca stabil untuk menanam bibit baru dan memupuk lahan.</div></div></div>
            <div class="aktivitas-item"><span class="aktivitas-dot dot-biru"></span><div><div class="aktivitas-judul">Minggu 2: Penyiraman rutin</div><div class="aktivitas-desc">Pastikan irigasi berjalan teratur karena curah hujan rendah.</div></div></div>
            <div class="aktivitas-item"><span class="aktivitas-dot dot-kuning"></span><div><div class="aktivitas-judul">Minggu 3: Pantau kondisi tanah</div><div class="aktivitas-desc">Periksa kelembaban tanah, tambahkan mulsa jika diperlukan untuk menjaga kelembaban.</div></div></div>
            <div class="aktivitas-item"><span class="aktivitas-dot dot-merah"></span><div><div class="aktivitas-judul">Minggu 4: Evaluasi & persiapan musim depan</div><div class="aktivitas-desc">Catat hasil dan siapkan rencana tanam untuk bulan berikutnya.</div></div></div>`;
    }
}

// ==========================================
// TAB SWITCHING
// ==========================================
function gantiPrediksiTab(tab, el) {
    document.querySelectorAll('.prediksi-tab').forEach(b => b.classList.remove('aktif'));
    el.classList.add('aktif');
    document.getElementById('tabMinggu').classList.toggle('hidden', tab !== 'minggu');
    document.getElementById('tabBulan').classList.toggle('hidden', tab !== 'bulan');
}
</script>
</body>
</html>