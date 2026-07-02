@extends('layouts.admin')

@section('title', 'Manajemen Diagnosis')
@section('page-title', '🔬 Manajemen Diagnosis')
@section('page-sub', 'Kelola dan proses diagnosis tanaman')

@section('content')

{{-- Stats --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:16px;margin-bottom:24px;">
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#e8f5e9;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">📊</div>
        <div><div style="font-size:1.85rem;font-weight:800;line-height:1;">{{ $total ?? 0 }}</div><div style="font-size:.74rem;color:#8fa89a;">Total</div></div>
    </div>
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#fef3c7;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">⏳</div>
        <div><div style="font-size:1.85rem;font-weight:800;line-height:1;color:#f59e0b;">{{ $pending ?? 0 }}</div><div style="font-size:.74rem;color:#8fa89a;">Pending</div></div>
    </div>
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#dcfce7;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">✅</div>
        <div><div style="font-size:1.85rem;font-weight:800;line-height:1;color:#22c55e;">{{ $completed ?? 0 }}</div><div style="font-size:.74rem;color:#8fa89a;">Selesai</div></div>
    </div>
</div>

{{-- Filter & Search --}}
<div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:20px;">
    <a href="{{ route('admin.diagnosis') }}" class="nav-link" style="background:#e8f5e9;color:#2e7d32;padding:8px 18px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.85rem;display:inline-block;">📋 Semua</a>
    <a href="{{ route('admin.diagnosis', ['status' => 'pending']) }}" style="background:#fef3c7;color:#92400e;padding:8px 18px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.85rem;display:inline-block;">⏳ Pending</a>
    <a href="{{ route('admin.diagnosis', ['status' => 'completed']) }}" style="background:#dcfce7;color:#166534;padding:8px 18px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.85rem;display:inline-block;">✅ Selesai</a>
</div>

<div style="margin-bottom:20px;">
    <form method="GET" action="{{ route('admin.diagnosis') }}" style="display:flex;gap:10px;flex-wrap:wrap;">
        <div style="flex:1;min-width:200px;">
            <input type="text" name="search" placeholder="Cari user atau nama penyakit..." 
                   value="{{ request('search') }}"
                   style="width:100%;padding:10px 16px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:14px;outline:none;font-family:'DM Sans',sans-serif;">
        </div>
        <button type="submit" style="padding:10px 24px;background:#4caf50;color:#fff;border:none;border-radius:8px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;">
            🔍 Cari
        </button>
        @if(request('search'))
            <a href="{{ route('admin.diagnosis') }}" style="padding:10px 20px;background:#e2e8e2;color:#1c2b1d;border:none;border-radius:8px;font-weight:600;text-decoration:none;font-family:'DM Sans',sans-serif;">
                Reset
            </a>
        @endif
    </form>
</div>

{{-- Table --}}
<div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;overflow:hidden;">
    <div style="padding:16px 22px;border-bottom:1px solid #e2e8e2;">
        <h3 style="font-size:.92rem;font-weight:800;">Daftar Diagnosis</h3>
    </div>
    <div class="table-responsive">
        <table style="width:100%;border-collapse:collapse;">
            <thead style="background:#f1f8e9;">
                <tr>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">#</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">User</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Foto</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Penyakit</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Status</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Tanggal</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($diagnosis as $d)
                <tr>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#8fa89a;">{{ $loop->iteration + ($diagnosis->currentPage() - 1) * $diagnosis->perPage() }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;font-weight:600;color:#1c2b1d;">{{ $d->user->nama ?? 'Unknown' }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">
                        @if($d->foto)
                            <img src="{{ asset('storage/'.$d->foto) }}" width="50" height="50" style="object-fit:cover;border-radius:6px;">
                        @else
                            <span style="color:#8fa89a;">-</span>
                        @endif
                    </td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $d->nama_penyakit ?? '-' }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;">
                        @if($d->nama_penyakit)
                            <span style="display:inline-flex;padding:3px 12px;border-radius:99px;font-size:.72rem;font-weight:700;background:#dcfce7;color:#166534;">✅ Selesai</span>
                        @else
                            <span style="display:inline-flex;padding:3px 12px;border-radius:99px;font-size:.72rem;font-weight:700;background:#fef3c7;color:#92400e;">⏳ Pending</span>
                        @endif
                    </td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $d->created_at->format('d/m/Y H:i') }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;">
                        <div style="display:flex;gap:8px;flex-wrap:wrap;">
                            <a href="{{ route('admin.diagnosis.process', $d->id) }}" style="color:#2563eb;text-decoration:none;font-weight:600;font-size:.8rem;">
                                <i class="fa-regular fa-pen-to-square"></i> Proses
                            </a>
                            <form action="{{ route('admin.diagnosis.delete', $d->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus diagnosis ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none;border:none;color:#dc2626;cursor:pointer;font-weight:600;font-size:.8rem;font-family:'DM Sans',sans-serif;">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding:40px 20px;text-align:center;color:#8fa89a;">
                        @if(request('search'))
                            Tidak ada diagnosis dengan kata kunci "{{ request('search') }}"
                        @else
                            Belum ada data diagnosis
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
    {{ $diagnosis->links() }}
</div>

@endsection