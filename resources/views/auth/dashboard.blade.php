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
    body { background-color: var(--bg-light); color: var(--text-dark); overflow-x: hidden; }
    
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
    .hamburger { display: none; cursor: pointer; flex-direction: column; gap: 5px; }
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

    .footer {
        background: linear-gradient(160deg, #0c4a6e 0%, #075985 100%);
        border-top: 1px solid rgba(255,255,255,0.1);
        padding: 2rem 1.5rem;
        text-align: center;
        color: white;
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
        .hamburger { display: flex; order: 2; }
        .user-profile { order: 3; }
        .user-name { display: none; }
        .nav-menu { position: fixed; top: 70px; left: -100%; flex-direction: column; background-color: var(--white); width: 100%; text-align: center; transition: 0.4s; box-shadow: 0 10px 15px rgba(0,0,0,0.05); padding: 30px 0; gap: 25px; }
        .nav-menu.active { left: 0; }
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
            <button class="btn-cta" onclick="window.location.href='#'">
                <i class="fa-solid fa-camera"></i> Mulai Identifikasi Sekarang
            </button>
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

            <div>
                <h3 class="text-slate-500 font-bold text-sm uppercase tracking-wider mb-4 border-b pb-2">Aktivitas Petani Minggu Ini</h3>
                
                <div class="space-y-4" id="rekAktivitasMinggu">
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex gap-4 items-start">
                        <div class="text-green-600 text-2xl mt-1">🌱</div>
                        <div>
                            <span class="inline-block bg-green-200 text-green-800 text-xs font-bold px-3 py-1 rounded-full mb-2">Penyiraman</span>
                            <h4 class="font-bold text-green-900 text-base">Kurangi frekuensi siram</h4>
                            <p class="text-sm text-green-800 mt-1">Kelembaban 82%, tanah masih cukup lembap. Siram hanya jika tanah kering saat disentuh.</p>
                        </div>
                    </div>

                    <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 flex gap-4 items-start">
                        <div class="text-orange-600 text-2xl mt-1">🍂</div>
                        <div>
                            <span class="inline-block bg-orange-200 text-orange-800 text-xs font-bold px-3 py-1 rounded-full mb-2">Pemupukan</span>
                            <h4 class="font-bold text-orange-900 text-base">Waktu tepat untuk pupuk daun</h4>
                            <p class="text-sm text-orange-800 mt-1">Suhu 29°C dan angin pelan (5 km/j) cocok untuk penyemprotan pupuk daun. Lakukan pagi hari.</p>
                        </div>
                    </div>

                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex gap-4 items-start">
                        <div class="text-red-600 text-2xl mt-1">🐛</div>
                        <div>
                            <span class="inline-block bg-red-200 text-red-800 text-xs font-bold px-3 py-1 rounded-full mb-2">Peringatan Hama</span>
                            <h4 class="font-bold text-red-900 text-base">Risiko jamur & wereng meningkat</h4>
                            <p class="text-sm text-red-800 mt-1">Kelembaban 82% mempercepat tumbuhnya jamur daun dan perkembangan wereng. Lakukan pengecekan rutin.</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Website Agro Clima Care (ACC). Semua Hak Dilindungi.</p>
    </footer>

    <script>
        // HAMBURGER MENU
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

        // GRAFIK CUACA
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

        // LOAD DATA IKLIM SAAT HALAMAN DIMUAT
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
// PREDIKSI CUACA
// ==========================================

// Flatpickr untuk tanggal
flatpickr("#inputTanggal_display", {
    dateFormat: "d/m/Y",
    maxDate: "today",
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

) {
    const kota = document.getElementById('inputDaerah').value;
    const tanggal = document.getElementById('inputTanggal').value;

    if (!kota || !tanggal) {
        document.getElementById('pesanError').classList.remove('hidden');
        return;
    }
    document.getElementById('pesanError').classList.add('hidden');

    // Tampilkan loading
    document.getElementById('hasilPrediksi').classList.remove('hidden');
    document.getElementById('hasilLokasi').textContent = '📍 ' + kota + ', Jawa Timur';
    document.getElementById('hasilTanggal').textContent = 'Memuat data...';
    document.getElementById('hasilSuhu').textContent = '--°';
    document.getElementById('hasilKondisi').textContent = 'Memuat...';
    document.getElementById('hasilLembab').textContent = '--%';
    document.getElementById('hasilAngin').textContent = '-- km/j';
    document.getElementById('hasilHujan').textContent = '-- mm';
    document.getElementById('hasilUV').textContent = '-- hPa';

    // Panggil API cuaca
    fetch('/api/cuaca?kota=' + encodeURIComponent(kota))
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                document.getElementById('hasilKondisi').textContent = 'Error: ' + data.error;
                return;
            }

            // Cari data untuk tanggal yang dipilih
            const targetDate = new Date(tanggal);
            const targetDateStr = targetDate.toISOString().split('T')[0];

            let foundData = null;
            for (let item of data.list) {
                const itemDate = item.dt_txt.split(' ')[0];
                if (itemDate === targetDateStr) {
                    foundData = item;
                    break;
                }
            }

            if (!foundData) {
                // Cari data terdekat
                let closestDiff = Infinity;
                for (let item of data.list) {
                    const itemDate = new Date(item.dt_txt);
                    const diff = Math.abs(itemDate - targetDate);
                    if (diff < closestDiff) {
                        closestDiff = diff;
                        foundData = item;
                    }
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

                // Update UI
                document.getElementById('hasilSuhu').textContent = temp + '°';
                document.getElementById('hasilKondisi').textContent = condition;
                document.getElementById('hasilLembab').textContent = humidity + '%';
               function cekPrediksi( document.getElementById('hasilAngin').textContent = windSpeed + ' km/j';
                document.getElementById('hasilHujan').textContent = (rain > 0 ? Math.round(rain * 10) / 10 : 0) + ' mm';
                document.getElementById('hasilUV').textContent = pressure + ' hPa';

                // Emoji
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

                // Format tanggal
                const d = new Date(foundData.dt_txt);
                const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][d.getDay()];
                const tgl = d.getDate();
                const bln = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][d.getMonth()];
                const thn = d.getFullYear();
                document.getElementById('hasilTanggal').textContent = hari + ', ' + tgl + ' ' + bln + ' ' + thn;

                // Generate rekomendasi
                generateRekomendasi(temp, humidity, rain, condition, kota, windSpeed);
            } else {
                document.getElementById('hasilKondisi').textContent = 'Data tidak ditemukan untuk tanggal ini';
            }
        })
        .catch(err => {
            document.getElementById('hasilKondisi').textContent = 'Error: ' + err.message;
        });
}

function generateRekomendasi(temp, humidity, rain, condition, kota, windSpeed) {
    const isRainy = rain > 0 || condition.includes('hujan');
    const isHot = temp > 30;
    const isHumid = humidity > 80;
    const isWindy = windSpeed > 20;

    // Banner
    let bannerEmoji, bannerTitle, bannerDetail;
    if (isRainy) {
        bannerEmoji = '🌧️';
        bannerTitle = 'Musim Hujan';
        bannerDetail = kota + ' • Waspada genangan';
    } else if (isHot) {
        bannerEmoji = '☀️';
        bannerTitle = 'Cuaca Panas';
        bannerDetail = kota + ' • Jaga hidrasi tanaman';
    } else {
        bannerEmoji = '⛅';
        bannerTitle = 'Cuaca Cerah';
        bannerDetail = kota + ' • Kondisi ideal untuk bertani';
    }

    document.getElementById('rekEmojiBanner').textContent = bannerEmoji;
    document.getElementById('rekJudulBanner').textContent = bannerTitle;
    document.getElementById('rekDetailBanner').textContent = bannerDetail + ' • ' + temp + '°C · Kelembaban ' + humidity + '%' + (isRainy ? ' · Peluang hujan ' + rain + ' mm' : '') + ' · Angin ' + windSpeed + ' km/j';

    // Kartu Minggu (7 hari)
    const mingguCards = document.getElementById('rekKartuMinggu');
    mingguCards.innerHTML = '';

    const days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    const weatherEmojis = isRainy ? ['🌧️', '☁️', '🌦️', '🌧️', '☁️', '🌦️', '🌧️'] : ['☀️', '⛅', '☀️', '🌤️', '⛅', '☀️', '🌤️'];
    const tempVariations = isHot ? [2, 1, 3, 0, 2, 1, 2] : [-1, 0, 1, -2, 0, 1, 0];

    days.forEach((day, i) => {
        const dayTemp = temp + tempVariations[i];
        const card = document.createElement('div');
        card.className = 'flex items-center justify-between p-3 rounded-xl bg-white border border-slate-200';
        card.innerHTML = `
            <div class="flex items-center gap-3">
                <span class="text-2xl">${weatherEmojis[i]}</span>
                <div>
                    <p class="text-sm font-semibold text-gray-800">${day}</p>
                    <p class="text-xs text-gray-500">${Math.round(dayTemp)}°C</p>
                </div>
            </div>
            <span class="text-xs text-gray-400">${isRainy ? 'Berpotensi hujan' : 'Cerah'}</span>
        `;
        mingguCards.appendChild(card);
    });

    // Aktivitas Minggu
    const aktivitasMinggu = document.getElementById('rekAktivitasMinggu');
    let aktivitasHTML = '';

    if (isRainy) {
        aktivitasHTML = `
            <div class="p-3 flex items-center gap-3">
                <span class="text-xl">🚫</span>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Hindari penyemprotan pestisida</p>
                    <p class="text-xs text-gray-500">Hujan dapat mengurangi efektivitas pestisida</p>
                </div>
            </div>
            <div class="p-3 flex items-center gap-3">
                <span class="text-xl">💧</span>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Kurangi frekuensi penyiraman</p>
                    <p class="text-xs text-gray-500">Kelembaban ${humidity}%, tanah masih cukup lembap</p>
                </div>
            </div>
            <div class="p-3 flex items-center gap-3">
                <span class="text-xl">⚠️</span>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Waspada jamur & wereng</p>
                    <p class="text-xs text-gray-500">Kelembaban ${humidity}% mempercepat pertumbuhan jamur</p>
                </div>
            </div>
        `;
    } else if (isHot) {
        aktivitasHTML = `
            <div class="p-3 flex items-center gap-3">
                <span class="text-xl">💧</span>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Perbanyak irigasi</p>
                    <p class="text-xs text-gray-500">Suhu ${temp}°C meningkatkan penguapan</p>
                </div>
            </div>
            <div class="p-3 flex items-center gap-3">
                <span class="text-xl">🌱</span>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Waktu tepat untuk pemupukan</p>
                    <p class="text-xs text-gray-500">Suhu ${temp}°C dan angin ${windSpeed} km/j cocok untuk pupuk daun</p>
                </div>
            </div>
            <div class="p-3 flex items-center gap-3">
                <span class="text-xl">✅</span>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Risiko jamur rendah</p>
                    <p class="text-xs text-gray-500">Kondisi aman untuk tanaman</p>
                </div>
            </div>
        `;
    } else {
        aktivitasHTML = `
            <div class="p-3 flex items-center gap-3">
                <span class="text-xl">🌱</span>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Kondisi mendukung untuk menanam</p>
                    <p class="text-xs text-gray-500">Suhu ${temp}°C dan kelembaban ${humidity}% ideal untuk pertumbuhan bibit</p>
                </div>
            </div>
            <div class="p-3 flex items-center gap-3">
                <span class="text-xl">✅</span>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Waktu tepat untuk penyemprotan</p>
                    <p class="text-xs text-gray-500">Cuaca cerah mendukung penyerapan optimal</p>
                </div>
            </div>
            <div class="p-3 flex items-center gap-3">
                <span class="text-xl">📋</span>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Perencanaan musim tanam</p>
                    <p class="text-xs text-gray-500">Kondisi stabil untuk persiapan lahan</p>
                </div>
            </div>
        `;
    }

    aktivitasMinggu.innerHTML = aktivitasHTML;

    // Aktivitas Bulan
    const aktivitasBulan = document.getElementById('rekAktivitasBulan');
    aktivitasBulan.innerHTML = `
        <div class="p-3 flex items-center gap-3">
            <span class="text-xl">📋</span>
            <div>
                <p class="text-sm font-semibold text-gray-800">Perencanaan musim tanam</p>
                <p class="text-xs text-gray-500">${isRainy ? 'Pilih varietas tahan hujan' : 'Pilih varietas tahan panas'}</p>
            </div>
        </div>
        <div class="p-3 flex items-center gap-3">
            <span class="text-xl">🧪</span>
            <div>
                <p class="text-sm font-semibold text-gray-800">Persiapan lahan</p>
                <p class="text-xs text-gray-500">${isRainy ? 'Buat saluran drainase' : 'Persiapkan sistem irigasi'}</p>
            </div>
        </div>
        <div class="p-3 flex items-center gap-3">
            <span class="text-xl">🌱</span>
            <div>
                <p class="text-sm font-semibold text-gray-800">${isRainy ? 'Perbanyak pupuk organik' : 'Perbanyak pupuk kompos'}</p>
                <p class="text-xs text-gray-500">${isRainy ? 'Nutrisi tercuci oleh hujan' : 'Kebutuhan nutrisi meningkat'}</p>
            </div>
        </div>
    `;

    // Kartu Bulan
    const bulanCards = document.getElementById('rekKartuBulan');
    bulanCards.innerHTML = '';
    const bulanNames = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
    const bulanEmojis = isRainy ? ['🌧️', '☁️', '🌦️', '🌧️'] : ['☀️', '⛅', '☀️', '🌤️'];
    const bulanDescs = isRainy ? ['Hujan sedang', 'Berawan', 'Hujan ringan', 'Hujan'] : ['Cerah', 'Berawan', 'Cerah terik', 'Cerah'];

    bulanNames.forEach((name, i) => {
        const card = document.createElement('div');
        card.className = 'flex items-center justify-between p-3 rounded-xl bg-white border border-slate-200';
        card.innerHTML = `
            <div class="flex items-center gap-3">
                <span class="text-2xl">${bulanEmojis[i]}</span>
                <div>
                    <p class="text-sm font-semibold text-gray-800">${name}</p>
                    <p class="text-xs text-gray-500">${bulanDescs[i]}</p>
                </div>
            </div>
            <span class="text-xs text-gray-400">~${Math.round(temp + (i * 0.5))}°C</span>
        `;
        bulanCards.appendChild(card);
    });

    // Judul bulan
    document.getElementById('rekJudulBulan').textContent = isRainy ? 'Prediksi: Musim Hujan' : isHot ? 'Prediksi: Musim Panas' : 'Prediksi: Cuaca Stabil';
    document.getElementById('rekDetailBulan').textContent = kota + ' • ' + (isRainy ? 'Persiapan antisipasi banjir' : isHot ? 'Persiapan antisipasi kekeringan' : 'Kondisi stabil untuk bertani');
}

function setTabRek(tab) {
    const tabMinggu = document.getElementById('tabMinggu');
    const tabBulan = document.getElementById('tabBulan');
    const rekMinggu = document.getElementById('rekMinggu');
    const rekBulan = document.getElementById('rekBulan');

    if (tab === 'minggu') {
        tabMinggu.className = 'flex-1 py-3 text-sm font-semibold text-sky-600 border-b-2 border-sky-500 bg-white transition-all';
        tabBulan.className = 'flex-1 py-3 text-sm font-semibold text-gray-400 border-b-2 border-transparent transition-all';
        rekMinggu.classList.remove('hidden');
        rekBulan.classList.add('hidden');
    } else {
        tabBulan.className = 'flex-1 py-3 text-sm font-semibold text-sky-600 border-b-2 border-sky-500 bg-white transition-all';
        tabMinggu.className = 'flex-1 py-3 text-sm font-semibold text-gray-400 border-b-2 border-transparent transition-all';
        rekBulan.classList.remove('hidden');
        rekMinggu.classList.add('hidden');
    }
}
    </script>
</body>
</html>