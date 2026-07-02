@extends('layouts.admin')

@section('title', 'Kelola Admin')
@section('page-title', '👥 Kelola Administrator')
@section('page-sub', 'Tambah, hapus, dan atur peran administrator sistem')

@section('content')

{{-- Stats --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:16px;margin-bottom:24px;">
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#e8f5e9;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">👥</div>
        <div><div style="font-size:1.85rem;font-weight:800;line-height:1;">{{ $totalAdmin ?? 0 }}</div><div style="font-size:.74rem;color:#8fa89a;">Total Admin</div></div>
    </div>
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#fef3c7;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">👑</div>
        <div><div style="font-size:1.85rem;font-weight:800;line-height:1;color:#f59e0b;">{{ $superAdmin ?? 0 }}</div><div style="font-size:.74rem;color:#8fa89a;">Super Admin</div></div>
    </div>
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#dbeafe;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">📋</div>
        <div><div style="font-size:1.85rem;font-weight:800;line-height:1;color:#2563eb;">{{ $adminKonten ?? 0 }}</div><div style="font-size:.74rem;color:#8fa89a;">Admin Konten</div></div>
    </div>
    <div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:14px;">
        <div style="width:46px;height:46px;border-radius:11px;background:#dcfce7;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">✅</div>
        <div><div style="font-size:1.85rem;font-weight:800;line-height:1;color:#22c55e;">{{ $adminAktif ?? 0 }}</div><div style="font-size:.74rem;color:#8fa89a;">Admin Aktif</div></div>
    </div>
</div>

{{-- Form Tambah Admin --}}
<div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:28px;margin-bottom:28px;">
    <h2 style="font-size:1rem;font-weight:700;margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid #e2e8e2;">
        ➕ Tambah Admin Baru
    </h2>

    <form method="POST" action="{{ route('admin.management.store') }}">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
                <label style="font-size:.78rem;font-weight:700;color:#37474f;letter-spacing:0.5px;text-transform:uppercase;display:block;margin-bottom:6px;">Nama Lengkap *</label>
                <input type="text" name="nama" placeholder="Nama lengkap admin" 
                       value="{{ old('nama') }}"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;" required>
                @error('nama') <small style="color:#dc2626;">{{ $message }}</small> @enderror
            </div>

            <div>
                <label style="font-size:.78rem;font-weight:700;color:#37474f;letter-spacing:0.5px;text-transform:uppercase;display:block;margin-bottom:6px;">Username *</label>
                <input type="text" name="username" placeholder="Username untuk login" 
                       value="{{ old('username') }}"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;" required>
                @error('username') <small style="color:#dc2626;">{{ $message }}</small> @enderror
            </div>

            <div>
                <label style="font-size:.78rem;font-weight:700;color:#37474f;letter-spacing:0.5px;text-transform:uppercase;display:block;margin-bottom:6px;">Email *</label>
                <input type="email" name="email" placeholder="Alamat email aktif" 
                       value="{{ old('email') }}"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;" required>
                @error('email') <small style="color:#dc2626;">{{ $message }}</small> @enderror
            </div>

            <div>
                <label style="font-size:.78rem;font-weight:700;color:#37474f;letter-spacing:0.5px;text-transform:uppercase;display:block;margin-bottom:6px;">Nomor Telepon *</label>
                <input type="text" name="phone" placeholder="Nomor telepon aktif" 
                       value="{{ old('phone') }}"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;" required>
                @error('phone') <small style="color:#dc2626;">{{ $message }}</small> @enderror
            </div>

            <div>
                <label style="font-size:.78rem;font-weight:700;color:#37474f;letter-spacing:0.5px;text-transform:uppercase;display:block;margin-bottom:6px;">Password *</label>
                <input type="password" name="password" placeholder="Password yang kuat" 
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;" required>
                @error('password') <small style="color:#dc2626;">{{ $message }}</small> @enderror
            </div>

            <div>
                <label style="font-size:.78rem;font-weight:700;color:#37474f;letter-spacing:0.5px;text-transform:uppercase;display:block;margin-bottom:6px;">Role / Peran *</label>
                <select name="role" style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;background:#fff;" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>👑 Super Admin - Akses penuh</option>
                    <option value="konten" {{ old('role') == 'konten' ? 'selected' : '' }}>📋 Admin Konten - Kelola Info Penyakit</option>
                    <option value="pengguna" {{ old('role') == 'pengguna' ? 'selected' : '' }}>👤 Admin Pengguna - Kelola Pengguna</option>
                    <option value="diagnosis" {{ old('role') == 'diagnosis' ? 'selected' : '' }}>🔬 Admin Diagnosis - Kelola Diagnosis</option>
                </select>
                @error('role') <small style="color:#dc2626;">{{ $message }}</small> @enderror
            </div>
        </div>

        <button type="submit" style="margin-top:20px;padding:12px 28px;background:#4caf50;color:#fff;border:none;border-radius:8px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;font-size:.9rem;">
            ➕ Tambah Admin
        </button>
    </form>
</div>

{{-- Tabel Daftar Admin --}}
<div style="background:#fff;border:1px solid #e2e8e2;border-radius:14px;overflow:hidden;">
    <div style="padding:16px 22px;border-bottom:1px solid #e2e8e2;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;">
        <h3 style="font-size:.92rem;font-weight:800;">Daftar Administrator ({{ $admins->count() }})</h3>
    </div>
    <div class="table-responsive">
        <table style="width:100%;border-collapse:collapse;">
            <thead style="background:#f1f8e9;">
                <tr>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">#</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Nama</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Username</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Email</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Role</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Status</th>
                    <th style="padding:11px 20px;text-align:left;font-size:.68rem;font-weight:800;letter-spacing:1px;text-transform:uppercase;color:#2e7d32;border-bottom:1px solid #e2e8e2;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $i => $a)
                <tr>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#8fa89a;">{{ $i + 1 }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;font-weight:600;color:#1c2b1d;">
                        {{ $a->nama }}
                        @if($a->id === Session::get('user_id'))
                            <span style="font-size:.7rem;color:#4caf50;font-weight:700;"> (Anda)</span>
                        @endif
                    </td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">@ {{ $a->username }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;color:#52706a;">{{ $a->email }}</td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;">
                        @php
                            $roleBadges = [
                                'superadmin' => ['👑 Super Admin', '#fef3c7', '#92400e'],
                                'konten' => ['📋 Admin Konten', '#dbeafe', '#1e40af'],
                                'pengguna' => ['👤 Admin Pengguna', '#dcfce7', '#166534'],
                                'diagnosis' => ['🔬 Admin Diagnosis', '#e8f5e9', '#2e7d32'],
                            ];
                            $badge = $roleBadges[$a->role] ?? [$a->role, '#f1f5f9', '#475569'];
                        @endphp
                        <span style="display:inline-flex;padding:3px 12px;border-radius:99px;font-size:.72rem;font-weight:700;background:{{ $badge[1] }};color:{{ $badge[2] }};">
                            {{ $badge[0] }}
                        </span>
                    </td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;">
                        <span style="display:inline-flex;padding:3px 12px;border-radius:99px;font-size:.72rem;font-weight:700;{{ $a->is_active ? 'background:#dcfce7;color:#166534;' : 'background:#fef2f2;color:#991b1b;' }}">
                            {{ $a->is_active ? '✅ Aktif' : '⛔ Nonaktif' }}
                        </span>
                    </td>
                    <td style="padding:13px 20px;font-size:.87rem;border-bottom:1px solid #edf2ed;">
                        @if($a->id === Session::get('user_id'))
                            <span style="font-size:.78rem;color:#8fa89a;">Tidak dapat mengubah akun sendiri</span>
                        @else
                            <div style="display:flex;gap:8px;flex-wrap:wrap;">
                                {{-- Tombol Edit (Modal atau redirect ke edit) --}}
                                <button onclick="openEditModal({{ $a->id }}, '{{ $a->nama }}', '{{ $a->role }}', {{ $a->is_active ? 'true' : 'false' }})" 
                                        style="color:#2563eb;background:none;border:none;cursor:pointer;font-weight:600;font-size:.8rem;font-family:'DM Sans',sans-serif;">
                                    ✏️ Edit
                                </button>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.management.delete', $a->id) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus admin {{ $a->nama }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="color:#dc2626;background:none;border:none;cursor:pointer;font-weight:600;font-size:.8rem;font-family:'DM Sans',sans-serif;">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding:40px 20px;text-align:center;color:#8fa89a;">Belum ada admin terdaftar</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Edit Admin --}}
<div id="editModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.5);z-index:9999;justify-content:center;align-items:center;backdrop-filter:blur(3px);">
    <div style="background:#fff;border-radius:16px;padding:30px;max-width:500px;width:90%;max-height:90vh;overflow-y:auto;box-shadow:0 20px 60px rgba(0,0,0,.3);">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;border-bottom:1px solid #e2e8e2;padding-bottom:12px;">
            <h2 style="font-size:1.1rem;font-weight:800;">✏️ Edit Admin</h2>
            <button onclick="closeEditModal()" style="background:none;border:none;font-size:1.5rem;cursor:pointer;color:#8fa89a;">&times;</button>
        </div>

        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')
            <input type="hidden" name="admin_id" id="edit_admin_id">
            
            <div style="margin-bottom:15px;">
                <label style="font-size:.78rem;font-weight:700;color:#37474f;text-transform:uppercase;display:block;margin-bottom:6px;">Nama Lengkap</label>
                <input type="text" name="nama" id="edit_nama" style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;" required>
            </div>

            <div style="margin-bottom:15px;">
                <label style="font-size:.78rem;font-weight:700;color:#37474f;text-transform:uppercase;display:block;margin-bottom:6px;">Role / Peran</label>
                <select name="role" id="edit_role" style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;background:#fff;" required>
                    <option value="superadmin">👑 Super Admin - Akses penuh</option>
                    <option value="konten">📋 Admin Konten - Kelola Info Penyakit</option>
                    <option value="pengguna">👤 Admin Pengguna - Kelola Pengguna</option>
                    <option value="diagnosis">🔬 Admin Diagnosis - Kelola Diagnosis</option>
                </select>
            </div>

            <div style="margin-bottom:15px;">
                <label style="font-size:.78rem;font-weight:700;color:#37474f;text-transform:uppercase;display:block;margin-bottom:6px;">Password (kosongkan jika tidak diubah)</label>
                <input type="password" name="password" id="edit_password" placeholder="Password baru" style="width:100%;padding:10px 14px;border:1.5px solid #e2e8e2;border-radius:8px;font-size:.9rem;outline:none;font-family:'DM Sans',sans-serif;">
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:flex;align-items:center;gap:8px;font-weight:600;cursor:pointer;">
                    <input type="checkbox" name="is_active" id="edit_is_active" value="1"> Aktif (admin dapat login)
                </label>
            </div>

            <div style="display:flex;gap:10px;">
                <button type="submit" style="padding:12px 28px;background:#4caf50;color:#fff;border:none;border-radius:8px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;font-size:.9rem;">
                    💾 Simpan Perubahan
                </button>
                <button type="button" onclick="closeEditModal()" style="padding:12px 28px;background:#e2e8e2;color:#1c2b1d;border:none;border-radius:8px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;font-size:.9rem;">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, nama, role, isActive) {
        document.getElementById('editModal').style.display = 'flex';
        document.getElementById('edit_admin_id').value = id;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_role').value = role;
        document.getElementById('edit_is_active').checked = isActive;
        document.getElementById('editForm').action = '/admin/admin-management/' + id;
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    // Tutup modal saat klik di luar
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });
</script>

@endsection