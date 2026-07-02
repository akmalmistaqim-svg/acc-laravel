@extends('layouts.admin')

@section('title', 'Kelola Info Penyakit')
@section('page-title', '📋 Kelola Info Penyakit')
@section('page-sub', 'Tambah, edit, dan hapus artikel informasi penyakit')

@section('content')

{{-- Form Tambah/Edit --}}
<div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:28px;margin-bottom:28px;">
    <h2 style="font-size:1rem;font-weight:700;margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid #e2e8e2;">
        @if(isset($editData) && $editData)
            ✏️ Edit Artikel
        @else
            ➕ Tambah Artikel Baru
        @endif
    </h2>

    <form method="POST" action="{{ isset($editData) && $editData ? route('admin.artikel.update', $editData->id) : route('admin.artikel.store') }}">
        @csrf
        @if(isset($editData) && $editData)
            @method('PUT')
        @endif

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div style="grid-column:1/-1;">
                <label style="font-size:.78rem;font-weight:700;color:#37474f;letter-spacing:0.5px;text-transform:uppercase;display:block;margin-bottom:6px;">Judul Artikel *</label>
                <input type="text" name="judul" placeholder="Contoh: Penyakit Blas pada Padi" 
                       value="{{ old('judul', isset($editData) ? $editData->judul : '') }}"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;" required>
                @error('judul') <small style="color:#dc2626;">{{ $message }}</small> @enderror
            </div>

            <div style="grid-column:1/-1;">
                <label style="font-size:.78rem;font-weight:700;color:#37474f;letter-spacing:0.5px;text-transform:uppercase;display:block;margin-bottom:6px;">URL Artikel *</label>
                <input type="url" name="url_artikel" placeholder="https://contoh.com/artikel" 
                       value="{{ old('url_artikel', isset($editData) ? $editData->url_artikel : '') }}"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;" required>
                @error('url_artikel') <small style="color:#dc2626;">{{ $message }}</small> @enderror
            </div>

            <div>
                <label style="font-size:.78rem;font-weight:700;color:#37474f;letter-spacing:0.5px;text-transform:uppercase;display:block;margin-bottom:6px;">Jenis Tanaman *</label>
                <input type="text" name="jenis_tanaman" placeholder="Padi, Cabai, Tomat" 
                       value="{{ old('jenis_tanaman', isset($editData) ? $editData->jenis_tanaman : '') }}"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;" required>
                @error('jenis_tanaman') <small style="color:#dc2626;">{{ $message }}</small> @enderror
            </div>

            <div>
                <label style="font-size:.78rem;font-weight:700;color:#37474f;letter-spacing:0.5px;text-transform:uppercase;display:block;margin-bottom:6px;">Kategori</label>
                <input type="text" name="kategori" placeholder="Jamur, Bakteri, Virus" 
                       value="{{ old('kategori', isset($editData) ? $editData->kategori : '') }}"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;">
                @error('kategori') <small style="color:#dc2626;">{{ $message }}</small> @enderror
            </div>

            <div style="grid-column:1/-1;">
                <label style="font-size:.78rem;font-weight:700;color:#37474f;letter-spacing:0.5px;text-transform:uppercase;display:block;margin-bottom:6px;">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat tentang penyakit ini..."
                          style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;resize:vertical;min-height:80px;">{{ old('deskripsi', isset($editData) ? $editData->deskripsi : '') }}</textarea>
                @error('deskripsi') <small style="color:#dc2626;">{{ $message }}</small> @enderror
            </div>

            @if(isset($editData) && $editData)
            <div style="grid-column:1/-1;">
                <label style="font-size:.78rem;font-weight:700;color:#37474f;letter-spacing:0.5px;text-transform:uppercase;display:block;margin-bottom:6px;">Status</label>
                <label style="display:flex;align-items:center;gap:8px;font-size:.9rem;font-weight:500;cursor:pointer;">
                    <input type="checkbox" name="is_active" {{ isset($editData) && $editData->is_active ? 'checked' : '' }}> Aktif (tampil di halaman publik)
                </label>
            </div>
            @endif
        </div>

        <div style="display:flex;gap:10px;margin-top:20px;">
            <button type="submit" style="padding:12px 28px;background:#4caf50;color:#fff;border:none;border-radius:8px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;font-size:.9rem;">
                @if(isset($editData) && $editData)
                    💾 Simpan Perubahan
                @else
                    ➕ Tambah Artikel
                @endif
            </button>
            @if(isset($editData) && $editData)
                <a href="{{ route('admin.artikel') }}" style="padding:12px 28px;background:#e2e8e2;color:#1c2b1d;border:none;border-radius:8px;font-weight:600;text-decoration:none;font-family:'DM Sans',sans-serif;font-size:.9rem;">
                    Batal
                </a>
            @endif
        </div>
    </form>
</div>

{{-- Table --}}
<div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;overflow:hidden;">
    <div style="padding:16px 22px;border-bottom:1px solid #e2e8e2;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;">
        <h3 style="font-size:.92rem;font-weight:800;">Daftar Artikel ({{ $artikel->count() }})</h3>
    </div>
    <div class="table-responsive">
        <table style="width:100%;border-collapse:collapse;">
            <thead style="background:#f1f8e9;">
                <tr>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">#</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Judul</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Tanaman</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Kategori</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Dibuat Oleh</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Status</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($artikel as $i => $a)
                <tr>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#8fa89a;">{{ $i + 1 }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;font-weight:600;color:#1c2b1d;">
                        <a href="{{ $a->url_artikel }}" target="_blank" style="color:#2e7d32;text-decoration:none;">
                            {{ $a->judul }}
                        </a>
                    </td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $a->jenis_tanaman }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $a->kategori ?: '–' }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $a->created_by ?: '–' }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;">
                        <span style="display:inline-flex;padding:3px 12px;border-radius:99px;font-size:.72rem;font-weight:700;{{ $a->is_active ? 'background:#dcfce7;color:#166534;' : 'background:#fef2f2;color:#991b1b;' }}">
                            {{ $a->is_active ? '✅ Aktif' : '⛔ Nonaktif' }}
                        </span>
                    </td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;">
                        <div style="display:flex;gap:8px;flex-wrap:wrap;">
                            <a href="{{ route('admin.artikel') }}?edit={{ $a->id }}" style="color:#2563eb;text-decoration:none;font-weight:600;font-size:.8rem;">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.artikel.delete', $a->id) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none;border:none;color:#dc2626;cursor:pointer;font-weight:600;font-size:.8rem;font-family:'DM Sans',sans-serif;">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding:40px 20px;text-align:center;color:#8fa89a;">Belum ada artikel. Tambahkan artikel di atas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection