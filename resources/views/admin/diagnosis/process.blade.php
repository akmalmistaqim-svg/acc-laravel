@extends('layouts.admin')

@section('title', 'Proses Diagnosis')
@section('page-title', '✏️ Proses Diagnosis')
@section('page-sub', 'Isi hasil diagnosis untuk pasien')

@section('content')

<div style="display:grid;grid-template-columns:1fr 1fr;gap:30px;">
    {{-- Kolom Kiri: Info User & Foto --}}
    <div>
        <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px;box-shadow:0 1px 3px rgba(0,0,0,.05);">
            <h3 style="font-size:16px;font-weight:700;margin-bottom:15px;">
                <i class="fa-regular fa-user"></i> Informasi User
            </h3>
            <p><strong>Nama:</strong> {{ $diagnosis->user->nama ?? '-' }}</p>
            <p><strong>Username:</strong> {{ $diagnosis->user->username ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $diagnosis->user->email ?? '-' }}</p>
            <p><strong>Tanggal Upload:</strong> {{ $diagnosis->created_at->format('d F Y H:i') }}</p>

            <hr style="margin:20px 0;border-color:#e2e8e2;">

            @if($diagnosis->foto)
                <img src="{{ asset('storage/'.$diagnosis->foto) }}" 
                     style="width:100%;max-height:400px;object-fit:contain;border-radius:8px;border:1px solid #e2e8e2;">
            @else
                <p style="color:#8fa89a;">Tidak ada foto</p>
            @endif
        </div>
    </div>

    {{-- Kolom Kanan: Form Proses Diagnosis --}}
    <div>
        <form action="{{ route('admin.diagnosis.process.store', $diagnosis->id) }}" method="POST">
            @csrf
            <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px;box-shadow:0 1px 3px rgba(0,0,0,.05);">
                <h3 style="font-size:16px;font-weight:700;margin-bottom:15px;">
                    <i class="fa-regular fa-pen-to-square"></i> Isi Hasil Diagnosis
                </h3>

                <div style="margin-bottom:15px;">
                    <label style="font-weight:600;font-size:14px;display:block;margin-bottom:5px;">Nama Penyakit *</label>
                    <input type="text" name="nama_penyakit" 
                           value="{{ old('nama_penyakit', $diagnosis->nama_penyakit) }}"
                           style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;"
                           placeholder="Contoh: Bercak Daun, Blas, dll" required>
                    @error('nama_penyakit')
                        <small style="color:#dc2626;">{{ $message }}</small>
                    @enderror
                </div>

                <div style="margin-bottom:15px;">
                    <label style="font-weight:600;font-size:14px;display:block;margin-bottom:5px;">Analisis / Catatan Admin *</label>
                    <textarea name="analisis" rows="4" 
                              style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;resize:vertical;min-height:100px;"
                              placeholder="Deskripsikan hasil analisis Anda..." required>{{ old('analisis', $diagnosis->analisis) }}</textarea>
                    @error('analisis')
                        <small style="color:#dc2626;">{{ $message }}</small>
                    @enderror
                </div>

                <div style="margin-bottom:20px;">
                    <label style="font-weight:600;font-size:14px;display:block;margin-bottom:5px;">Saran Penanganan *</label>
                    <textarea name="saran_penanganan" rows="4" 
                              style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;resize:vertical;min-height:100px;"
                              placeholder="Berikan saran penanganan untuk petani..." required>{{ old('saran_penanganan', $diagnosis->saran_penanganan) }}</textarea>
                    @error('saran_penanganan')
                        <small style="color:#dc2626;">{{ $message }}</small>
                    @enderror
                </div>

                <div style="display:flex;gap:12px;flex-wrap:wrap;">
                    <button type="submit" style="padding:12px 28px;background:#4caf50;color:#fff;border:none;border-radius:8px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;font-size:.9rem;">
                        <i class="fa-regular fa-floppy-disk"></i> Simpan Diagnosis
                    </button>
                    <a href="{{ route('admin.diagnosis') }}" style="padding:12px 28px;background:#e2e8e2;color:#1c2b1d;border:none;border-radius:8px;font-weight:600;text-decoration:none;font-family:'DM Sans',sans-serif;font-size:.9rem;">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection