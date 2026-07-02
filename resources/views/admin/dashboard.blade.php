@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-sub', 'Ringkasan aktivitas sistem')

@section('content')

@php
    $role = Session::get('admin_role');
    $nama = Session::get('admin_nama');
@endphp

{{-- Welcome Banner --}}
<div style="background:linear-gradient(135deg,#1b5e20 0%,#2e7d32 55%,#388e3c 100%);border-radius:14px;padding:26px 30px;display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;position:relative;overflow:hidden;flex-wrap:wrap;gap:16px;">
    <div style="position:relative;z-index:1;">
        <h2 style="font-size:1.3rem;font-weight:800;color:#fff;margin-bottom:4px;">Halo, {{ $nama }}! 👋</h2>
        <p style="font-size:.87rem;color:rgba(255,255,255,.7);">
            @if($role === 'superadmin')
                Anda memiliki akses penuh. Kelola semua aspek sistem dari sini.
            @elseif($role === 'konten')
                Anda dapat mengelola artikel dan informasi penyakit tanaman.
            @elseif($role === 'pengguna')
                Anda dapat mengelola dan memantau akun pengguna yang terdaftar.
            @elseif($role === 'diagnosis')
                Anda dapat mengelola dan memproses diagnosis tanaman.
            @else
                Selamat datang di Admin Panel.
            @endif
        </p>
    </div>
    <div style="position:relative;z-index:1;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);border-radius:10px;padding:12px 18px;text-align:center;">
        <div style="font-size:1.6rem;">
            @if($role === 'superadmin') 👑
            @elseif($role === 'konten') 📋
            @elseif($role === 'pengguna') 👤
            @elseif($role === 'diagnosis') 🔬
            @endif
        </div>
        <div style="font-size:.75rem;font-weight:700;color:rgba(255,255,255,.8);">
            @if($role === 'superadmin') Super Admin
            @elseif($role === 'konten') Admin Konten
            @elseif($role === 'pengguna') Admin Pengguna
            @elseif($role === 'diagnosis') Admin Diagnosis
            @endif
        </div>
    </div>
</div>

{{-- Stats --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:16px;margin-bottom:26px;">
    
    {{-- Stat Diagnosis: hanya untuk superadmin & diagnosis --}}
    @if(in_array($role, ['superadmin', 'diagnosis']))
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#e8f5e9;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">🔬</div>
        <div>
            <div style="font-size:1.85rem;font-weight:800;line-height:1;">{{ $statDiagnosis ?? 0 }}</div>
            <div style="font-size:.74rem;color:#8fa89a;">Total Diagnosis</div>
        </div>
    </div>
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#fef3c7;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">⏳</div>
        <div>
            <div style="font-size:1.85rem;font-weight:800;line-height:1;color:#f59e0b;">{{ $statPending ?? 0 }}</div>
            <div style="font-size:.74rem;color:#8fa89a;">Pending</div>
        </div>
    </div>
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#dcfce7;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">✅</div>
        <div>
            <div style="font-size:1.85rem;font-weight:800;line-height:1;color:#22c55e;">{{ $statCompleted ?? 0 }}</div>
            <div style="font-size:.74rem;color:#8fa89a;">Selesai</div>
        </div>
    </div>
    @endif

    {{-- Stat Pengguna: semua admin bisa lihat --}}
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#eff6ff;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">👤</div>
        <div>
            <div style="font-size:1.85rem;font-weight:800;line-height:1;">{{ $statPengguna ?? 0 }}</div>
            <div style="font-size:.74rem;color:#8fa89a;">Pengguna</div>
        </div>
    </div>

    {{-- Stat Admin: hanya superadmin yang bisa lihat --}}
    @if($role === 'superadmin')
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#f5f3ff;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">👥</div>
        <div>
            <div style="font-size:1.85rem;font-weight:800;line-height:1;">{{ $statAdmin ?? 0 }}</div>
            <div style="font-size:.74rem;color:#8fa89a;">Total Admin</div>
        </div>
    </div>
    @endif

    {{-- Stat Artikel: semua admin bisa lihat --}}
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#dcfce7;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">🌿</div>
        <div>
            <div style="font-size:1.85rem;font-weight:800;line-height:1;">{{ $statArtikel ?? 0 }}</div>
            <div style="font-size:.74rem;color:#8fa89a;">Artikel</div>
        </div>
    </div>

    {{-- Stat Pendaftaran Baru: semua admin bisa lihat --}}
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#fef3c7;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">📅</div>
        <div>
            <div style="font-size:1.85rem;font-weight:800;line-height:1;color:#f59e0b;">{{ $statBaru ?? 0 }}</div>
            <div style="font-size:.74rem;color:#8fa89a;">Daftar Hari Ini</div>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div style="font-size:.9rem;font-weight:800;margin-bottom:14px;">⚡ Aksi Cepat</div>
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:28px;">

    {{-- Diagnosis: superadmin & diagnosis --}}
    @if(in_array($role, ['superadmin', 'diagnosis']))
    <a href="{{ route('admin.diagnosis') }}" style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:24px;text-decoration:none;transition:all .22s;box-shadow:0 1px 3px rgba(0,0,0,.05);">
        <div style="font-size:1.8rem;margin-bottom:12px;">🔬</div>
        <h3 style="font-size:.92rem;font-weight:800;color:#1c2b1d;margin-bottom:5px;">Kelola Diagnosis</h3>
        <p style="font-size:.8rem;color:#52706a;">Proses diagnosis yang pending</p>
    </a>
    @endif

    {{-- Pengguna: superadmin & pengguna --}}
    @if(in_array($role, ['superadmin', 'pengguna']))
    <a href="{{ route('admin.users') }}" style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:24px;text-decoration:none;transition:all .22s;box-shadow:0 1px 3px rgba(0,0,0,.05);">
        <div style="font-size:1.8rem;margin-bottom:12px;">👤</div>
        <h3 style="font-size:.92rem;font-weight:800;color:#1c2b1d;margin-bottom:5px;">Kelola Pengguna</h3>
        <p style="font-size:.8rem;color:#52706a;">Lihat dan hapus akun pengguna</p>
    </a>
    @endif

    {{-- Artikel: superadmin & konten --}}
    @if(in_array($role, ['superadmin', 'konten']))
    <a href="{{ route('admin.artikel') }}" style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:24px;text-decoration:none;transition:all .22s;box-shadow:0 1px 3px rgba(0,0,0,.05);">
        <div style="font-size:1.8rem;margin-bottom:12px;">📋</div>
        <h3 style="font-size:.92rem;font-weight:800;color:#1c2b1d;margin-bottom:5px;">Kelola Artikel</h3>
        <p style="font-size:.8rem;color:#52706a;">Tambah, edit, hapus artikel</p>
    </a>
    @endif

    {{-- Kelola Admin: HANYA superadmin --}}
    @if($role === 'superadmin')
    <a href="{{ route('admin.management') }}" style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:24px;text-decoration:none;transition:all .22s;box-shadow:0 1px 3px rgba(0,0,0,.05);">
        <div style="font-size:1.8rem;margin-bottom:12px;">👥</div>
        <h3 style="font-size:.92rem;font-weight:800;color:#1c2b1d;margin-bottom:5px;">Kelola Admin</h3>
        <p style="font-size:.8rem;color:#52706a;">Tambah, hapus, atur role admin</p>
    </a>
    @endif

</div>

{{-- Recent Diagnosis: hanya untuk superadmin & diagnosis --}}
@if(in_array($role, ['superadmin', 'diagnosis']))
<div style="font-size:.9rem;font-weight:800;margin-bottom:14px;">📋 Diagnosis Terbaru</div>
<div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;overflow:hidden;">
    <div style="padding:16px 22px;border-bottom:1px solid #e2e8e2;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;">
        <h3 style="font-size:.92rem;font-weight:800;">Diagnosis Terbaru</h3>
        <a href="{{ route('admin.diagnosis') }}" style="font-size:.8rem;color:#4caf50;text-decoration:none;font-weight:600;">Lihat semua →</a>
    </div>
    <div class="table-responsive">
        <table style="width:100%;border-collapse:collapse;">
            <thead style="background:#f1f8e9;">
                <tr>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">User</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Penyakit</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Status</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Tanggal</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentDiagnosis ?? [] as $d)
                <tr>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;font-weight:600;">{{ $d->user->nama ?? 'Unknown' }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $d->nama_penyakit ?? '-' }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">
                        @if($d->nama_penyakit)
                            <span style="display:inline-flex;padding:3px 12px;border-radius:99px;font-size:.72rem;font-weight:700;background:#dcfce7;color:#166534;">✅ Selesai</span>
                        @else
                            <span style="display:inline-flex;padding:3px 12px;border-radius:99px;font-size:.72rem;font-weight:700;background:#fef3c7;color:#92400e;">⏳ Pending</span>
                        @endif
                    </td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $d->created_at->format('d/m/Y H:i') }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">
                        <a href="{{ route('admin.diagnosis.process', $d->id) }}" style="color:#2563eb;text-decoration:none;font-weight:600;font-size:.8rem;">
                            <i class="fa-regular fa-pen-to-square"></i> Proses
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding:30px 20px;text-align:center;color:#8fa89a;">Belum ada data diagnosis</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- Daftar Pengguna Terbaru: hanya untuk superadmin & pengguna --}}
@if(in_array($role, ['superadmin', 'pengguna']))
<div style="font-size:.9rem;font-weight:800;margin-bottom:14px;margin-top:28px;">👤 Pengguna Terbaru</div>
<div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;overflow:hidden;">
    <div style="padding:16px 22px;border-bottom:1px solid #e2e8e2;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;">
        <h3 style="font-size:.92rem;font-weight:800;">Pengguna Terbaru</h3>
        <a href="{{ route('admin.users') }}" style="font-size:.8rem;color:#4caf50;text-decoration:none;font-weight:600;">Lihat semua →</a>
    </div>
    <div class="table-responsive">
        <table style="width:100%;border-collapse:collapse;">
            <thead style="background:#f1f8e9;">
                <tr>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Nama</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Username</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Email</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Terdaftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users ?? [] as $u)
                <tr>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;font-weight:600;color:#1c2b1d;">{{ $u->nama }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">@ {{ $u->username }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $u->email }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $u->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding:30px 20px;text-align:center;color:#8fa89a;">Belum ada pengguna terdaftar</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- Daftar Artikel Terbaru: hanya untuk superadmin & konten --}}
@if(in_array($role, ['superadmin', 'konten']))
<div style="font-size:.9rem;font-weight:800;margin-bottom:14px;margin-top:28px;">📋 Artikel Terbaru</div>
<div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;overflow:hidden;">
    <div style="padding:16px 22px;border-bottom:1px solid #e2e8e2;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;">
        <h3 style="font-size:.92rem;font-weight:800;">Artikel Terbaru</h3>
        <a href="{{ route('admin.artikel') }}" style="font-size:.8rem;color:#4caf50;text-decoration:none;font-weight:600;">Lihat semua →</a>
    </div>
    <div class="table-responsive">
        <table style="width:100%;border-collapse:collapse;">
            <thead style="background:#f1f8e9;">
                <tr>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Judul</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Tanaman</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Status</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($artikel ?? [] as $a)
                <tr>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;font-weight:600;color:#1c2b1d;">
                        <a href="{{ $a->url_artikel }}" target="_blank" style="color:#2e7d32;text-decoration:none;">
                            {{ $a->judul }}
                        </a>
                    </td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $a->jenis_tanaman }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;">
                        <span style="display:inline-flex;padding:3px 12px;border-radius:99px;font-size:.72rem;font-weight:700;{{ $a->is_active ? 'background:#dcfce7;color:#166534;' : 'background:#fef2f2;color:#991b1b;' }}">
                            {{ $a->is_active ? '✅ Aktif' : '⛔ Nonaktif' }}
                        </span>
                    </td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $a->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding:30px 20px;text-align:center;color:#8fa89a;">Belum ada artikel</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- Daftar Admin: hanya untuk superadmin --}}
@if($role === 'superadmin')
<div style="font-size:.9rem;font-weight:800;margin-bottom:14px;margin-top:28px;">👥 Daftar Admin</div>
<div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;overflow:hidden;">
    <div style="padding:16px 22px;border-bottom:1px solid #e2e8e2;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;">
        <h3 style="font-size:.92rem;font-weight:800;">Admin Terbaru</h3>
        <a href="{{ route('admin.management') }}" style="font-size:.8rem;color:#4caf50;text-decoration:none;font-weight:600;">Kelola Admin →</a>
    </div>
    <div class="table-responsive">
        <table style="width:100%;border-collapse:collapse;">
            <thead style="background:#f1f8e9;">
                <tr>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Nama</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Username</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Role</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins ?? [] as $a)
                <tr>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;font-weight:600;color:#1c2b1d;">{{ $a->nama }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">@ {{ $a->username }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;">
                        @if($a->role === 'superadmin')
                            <span style="display:inline-flex;padding:3px 12px;border-radius:99px;font-size:.72rem;font-weight:700;background:#fef3c7;color:#92400e;">👑 Super Admin</span>
                        @elseif($a->role === 'konten')
                            <span style="display:inline-flex;padding:3px 12px;border-radius:99px;font-size:.72rem;font-weight:700;background:#dbeafe;color:#1e40af;">📋 Konten</span>
                        @elseif($a->role === 'pengguna')
                            <span style="display:inline-flex;padding:3px 12px;border-radius:99px;font-size:.72rem;font-weight:700;background:#dcfce7;color:#166534;">👤 Pengguna</span>
                        @elseif($a->role === 'diagnosis')
                            <span style="display:inline-flex;padding:3px 12px;border-radius:99px;font-size:.72rem;font-weight:700;background:#e8f5e9;color:#2e7d32;">🔬 Diagnosis</span>
                        @endif
                    </td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;">
                        <span style="display:inline-flex;padding:3px 12px;border-radius:99px;font-size:.72rem;font-weight:700;{{ $a->is_active ? 'background:#dcfce7;color:#166534;' : 'background:#fef2f2;color:#991b1b;' }}">
                            {{ $a->is_active ? '✅ Aktif' : '⛔ Nonaktif' }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding:30px 20px;text-align:center;color:#8fa89a;">Belum ada admin terdaftar</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection