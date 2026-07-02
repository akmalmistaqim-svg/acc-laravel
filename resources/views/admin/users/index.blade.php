@extends('layouts.admin')

@section('title', 'Kelola Pengguna')
@section('page-title', '👤 Kelola Pengguna')
@section('page-sub', 'Lihat dan hapus akun pengguna')

@section('content')

{{-- Stats --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:16px;margin-bottom:24px;">
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#eff6ff;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">👥</div>
        <div><div style="font-size:1.85rem;font-weight:800;line-height:1;">{{ $total ?? 0 }}</div><div style="font-size:.74rem;color:#8fa89a;">Total Pengguna</div></div>
    </div>
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#fef3c7;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">📅</div>
        <div><div style="font-size:1.85rem;font-weight:800;line-height:1;color:#f59e0b;">{{ $baruHariIni ?? 0 }}</div><div style="font-size:.74rem;color:#8fa89a;">Daftar Hari Ini</div></div>
    </div>
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#e8f5e9;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">🔍</div>
        <div><div style="font-size:1.85rem;font-weight:800;line-height:1;">{{ $users->total() }}</div><div style="font-size:.74rem;color:#8fa89a;">Hasil Pencarian</div></div>
    </div>
</div>

{{-- Search --}}
<div style="margin-bottom:20px;">
    <form method="GET" action="{{ route('admin.users') }}" style="display:flex;gap:10px;flex-wrap:wrap;">
        <div style="flex:1;min-width:200px;">
            <input type="text" name="cari" placeholder="Cari nama, username, atau email..." 
                   value="{{ $keyword ?? '' }}"
                   style="width:100%;padding:10px 16px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:14px;outline:none;font-family:'DM Sans',sans-serif;">
        </div>
        <button type="submit" style="padding:10px 24px;background:#4caf50;color:#fff;border:none;border-radius:8px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;">
            🔍 Cari
        </button>
        @if(!empty($keyword))
            <a href="{{ route('admin.users') }}" style="padding:10px 20px;background:#e2e8e2;color:#1c2b1d;border:none;border-radius:8px;font-weight:600;text-decoration:none;font-family:'DM Sans',sans-serif;">
                Reset
            </a>
        @endif
    </form>
</div>

{{-- Table --}}
<div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;overflow:hidden;">
    <div style="padding:16px 22px;border-bottom:1px solid #e2e8e2;">
        <h3 style="font-size:.92rem;font-weight:800;">Daftar Pengguna</h3>
    </div>
    <div class="table-responsive">
        <table style="width:100%;border-collapse:collapse;">
            <thead style="background:#f1f8e9;">
                <tr>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">#</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Nama</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Username</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Email</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Phone</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Terdaftar</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#8fa89a;">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;font-weight:600;color:#1c2b1d;">{{ $u->nama }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">@ {{ $u->username }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $u->email }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $u->phone }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $u->created_at->format('d M Y') }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;">
                        <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus user {{ $u->nama }}? Semua data diagnosisnya juga akan terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="padding:6px 14px;background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:6px;font-weight:600;font-size:.78rem;cursor:pointer;font-family:'DM Sans',sans-serif;transition:all .15s;">
                                🗑️ Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding:40px 20px;text-align:center;color:#8fa89a;">
                        @if(!empty($keyword))
                            Tidak ada pengguna dengan kata kunci "{{ $keyword }}"
                        @else
                            Belum ada pengguna terdaftar
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination --}}
<div style="margin-top:20px;">
    {{ $users->links() }}
</div>

@endsection