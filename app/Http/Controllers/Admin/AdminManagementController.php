<?php
// app/Http/Controllers/Admin/AdminManagementController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminManagementController extends Controller
{
    public function index()
    {
        // Ambil semua user dengan role admin (superadmin, konten, pengguna, diagnosis)
        $admins = AccUser::whereIn('role', ['superadmin', 'konten', 'pengguna', 'diagnosis'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Statistik
        $totalAdmin = $admins->count();
        $superAdmin = AccUser::where('role', 'superadmin')->count();
        $adminKonten = AccUser::where('role', 'konten')->count();
        $adminPengguna = AccUser::where('role', 'pengguna')->count();
        $adminDiagnosis = AccUser::where('role', 'diagnosis')->count();
        $adminAktif = $admins->where('is_active', true)->count();

        return view('admin.admin-management.index', compact(
            'admins',
            'totalAdmin',
            'superAdmin',
            'adminKonten',
            'adminPengguna',
            'adminDiagnosis',
            'adminAktif'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|unique:acc_users,username|max:50',
            'email' => 'required|email|unique:acc_users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'role' => 'required|in:superadmin,konten,pengguna,diagnosis',
        ]);

        AccUser::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        return back()->with('success', 'Admin baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $admin = AccUser::findOrFail($id);

        // Cegah mengubah akun sendiri
        if ($admin->id === Session::get('user_id')) {
            return back()->with('error', 'Anda tidak dapat mengubah akun Anda sendiri!');
        }

        $request->validate([
            'nama' => 'required|string|max:100',
            'role' => 'required|in:superadmin,konten,pengguna,diagnosis',
            'is_active' => 'nullable|boolean',
        ]);

        $admin->update([
            'nama' => $request->nama,
            'role' => $request->role,
            'is_active' => $request->has('is_active'),
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:6']);
            $admin->update(['password' => Hash::make($request->password)]);
        }

        return back()->with('success', 'Admin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $admin = AccUser::findOrFail($id);

        // Cegah menghapus akun sendiri
        if ($admin->id === Session::get('user_id')) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        // Cegah menghapus superadmin terakhir
        if ($admin->role === 'superadmin' && AccUser::where('role', 'superadmin')->count() <= 1) {
            return back()->with('error', 'Tidak dapat menghapus Super Admin terakhir!');
        }

        $admin->delete();
        return back()->with('success', 'Admin berhasil dihapus!');
    }
}