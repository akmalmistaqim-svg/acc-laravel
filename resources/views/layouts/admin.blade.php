<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Admin ACC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --green: #2e7d32;
            --green-mid: #4caf50;
            --green-light: #e8f5e9;
            --sidebar-bg: #0d1f0e;
            --body-bg: #f4f6f4;
            --card: #ffffff;
            --text: #1c2b1d;
            --text-2: #52706a;
            --text-3: #8fa89a;
            --border: #e2e8e2;
            --border-2: #edf2ed;
            --red: #dc2626;
            --red-soft: #fef2f2;
            --gold: #f59e0b;
            --gold-soft: #fef3c7;
            --blue: #2563eb;
            --blue-soft: #eff6ff;
            --purple: #7c3aed;
            --purple-soft: #f5f3ff;
            --sidebar-w: 260px;
            --radius: 14px;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--body-bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            min-height: 100vh;
            position: fixed;
            left: 0; top: 0;
            display: flex;
            flex-direction: column;
            z-index: 200;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 24px 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,.06);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        .brand-name { font-size: 1.15rem; font-weight: 800; color: #fff; }
        .brand-sub { font-size: .65rem; font-weight: 600; color: rgba(255,255,255,.3); letter-spacing: 2px; text-transform: uppercase; }
        .admin-pill {
            margin: 14px 14px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 10px;
            padding: 10px 12px;
        }
        .admin-ava {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, #4caf50, #81c784);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            font-weight: 800;
            color: #fff;
            flex-shrink: 0;
        }
        .admin-info-name { font-size: .82rem; font-weight: 700; color: #fff; line-height: 1.2; }
        .admin-info-role { font-size: .67rem; color: rgba(255,255,255,.35); }
        .sidebar-section { padding: 18px 12px 6px; }
        .section-label {
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255,255,255,.25);
            padding: 0 8px;
            margin-bottom: 4px;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 9px;
            text-decoration: none;
            color: rgba(255,255,255,.55);
            font-size: .86rem;
            font-weight: 500;
            transition: all .18s;
            border-left: 2px solid transparent;
            margin-bottom: 1px;
        }
        .nav-link:hover { background: rgba(255,255,255,.06); color: rgba(255,255,255,.9); }
        .nav-link.active { background: rgba(76,175,80,.14); color: #81c784; border-left-color: #4caf50; }
        .nav-link.locked { opacity: .3; pointer-events: none; }
        .nav-icon { font-size: .9rem; width: 18px; text-align: center; flex-shrink: 0; }
        .sidebar-footer {
            margin-top: auto;
            padding: 14px 12px;
            border-top: 1px solid rgba(255,255,255,.06);
        }
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border-radius: 8px;
            background: rgba(220,38,38,.1);
            border: 1px solid rgba(220,38,38,.2);
            color: #fca5a5;
            text-decoration: none;
            font-size: .83rem;
            font-weight: 600;
            transition: all .18s;
        }
        .logout-btn:hover { background: rgba(220,38,38,.2); color: #fff; }

        /* MAIN */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: var(--card);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0; z-index: 100;
        }
        .topbar-title { font-size: 1.05rem; font-weight: 800; }
        .topbar-sub { font-size: .75rem; color: var(--text-3); margin-top: 1px; }
        .topbar-date { font-size: .82rem; color: var(--text-3); background: var(--body-bg); border: 1px solid var(--border); padding: 6px 14px; border-radius: 8px; }

        .content { padding: 28px 32px; flex: 1; }

        /* ALERT */
        .alert {
            display: flex; align-items: center; gap: 12px;
            padding: 14px 18px; border-radius: 11px;
            font-size: .87rem; font-weight: 500;
            margin-bottom: 22px;
            border: 1px solid transparent;
            animation: slideDown .3s ease both;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .alert-success { background: var(--green-light); color: var(--green); border-color: #c8e6c9; }
        .alert-danger { background: var(--red-soft); color: var(--red); border-color: #fecaca; }

        /* HAMBURGER (MOBILE) */
        .hamburger {
            display: none;
            position: fixed;
            top: 14px; left: 14px;
            z-index: 400;
            background: #4caf50;
            border: none;
            border-radius: 8px;
            width: 40px; height: 40px;
            cursor: pointer;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            box-shadow: 0 2px 8px rgba(0,0,0,.25);
        }
        .hamburger span {
            display: block;
            width: 20px; height: 2px;
            background: #fff;
            border-radius: 2px;
            transition: all .3s;
        }
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,.5);
            z-index: 150;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.show { display: block; }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hamburger { display: flex; }
            .sidebar {
                transform: translateX(-100%);
                transition: transform .3s cubic-bezier(.4,0,.2,1);
                z-index: 300;
            }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0 !important; }
            .topbar { padding-left: 64px !important; }
            .content { padding: 20px 16px !important; }
            .sidebar-overlay.show { display: block; }
        }

        /* TABLE RESPONSIVE */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .table-responsive table {
            min-width: 700px;
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- HAMBURGER BUTTON -->
    <button class="hamburger" id="hamburgerBtn">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">🌿</div>
            <div>
                <div class="brand-name">ACC</div>
                <div class="brand-sub">Admin Panel</div>
            </div>
        </div>

        <div class="admin-pill">
            <div class="admin-ava">{{ strtoupper(substr(Session::get('admin_nama', 'A'), 0, 1)) }}</div>
            <div>
                <div class="admin-info-name">{{ Session::get('admin_nama', 'Admin') }}</div>
                <div class="admin-info-role">
                    @php
                        $role = Session::get('admin_role', 'user');
                        $roleLabels = [
                            'superadmin' => '👑 Super Admin',
                            'konten' => '📋 Admin Konten',
                            'pengguna' => '👤 Admin Pengguna',
                            'diagnosis' => '🔬 Admin Diagnosis',
                        ];
                        echo $roleLabels[$role] ?? ucfirst($role);
                    @endphp
                </div>
            </div>
        </div>

        <div class="sidebar-section">
            <div class="section-label">Menu Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon">📊</span> Dashboard
            </a>
        </div>

        <div class="sidebar-section">
            <div class="section-label">Manajemen</div>

            @php
                $role = Session::get('admin_role', 'user');
            @endphp

            {{-- Diagnosis: superadmin & diagnosis --}}
            @if(in_array($role, ['superadmin', 'diagnosis']))
                <a href="{{ route('admin.diagnosis') }}" class="nav-link {{ request()->routeIs('admin.diagnosis*') ? 'active' : '' }}">
                    <span class="nav-icon">🔬</span> Diagnosis
                </a>
            @endif

            {{-- Kelola Pengguna: superadmin & pengguna --}}
            @if(in_array($role, ['superadmin', 'pengguna']))
                <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <span class="nav-icon">👤</span> Kelola Pengguna
                </a>
            @endif

            {{-- Info Penyakit: superadmin & konten --}}
            @if(in_array($role, ['superadmin', 'konten']))
                <a href="{{ route('admin.artikel') }}" class="nav-link {{ request()->routeIs('admin.artikel*') ? 'active' : '' }}">
                    <span class="nav-icon">📋</span> Info Penyakit
                </a>
            @endif

            {{-- Kelola Admin: HANYA superadmin --}}
            @if($role === 'superadmin')
                <a href="{{ route('admin.management') }}" class="nav-link {{ request()->routeIs('admin.management*') ? 'active' : '' }}">
                    <span class="nav-icon">👥</span> Kelola Admin
                </a>
            @endif
        </div>

        <div class="sidebar-footer">
            <a href="{{ url('/logout') }}" class="logout-btn">🚪 Logout</a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main">
        <div class="topbar">
            <div>
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="topbar-sub">@yield('page-sub', 'Selamat datang di panel admin')</div>
            </div>
            <div class="topbar-date">📅 {{ date('d F Y') }}</div>
        </div>

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">❌ {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </main>

    <script>
        // SIDEBAR TOGGLE
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        }

        hamburgerBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // Close sidebar on escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar.classList.contains('open')) {
                toggleSidebar();
            }
        });
    </script>
</body>
</html>