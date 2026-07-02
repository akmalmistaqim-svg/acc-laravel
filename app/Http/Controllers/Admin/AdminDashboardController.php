<?php
// app/Http/Controllers/Admin/AdminDashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfoPenyakit;
use App\Models\AccUser;
use App\Models\HasilDiagnosis;
use Illuminate\Support\Facades\Session;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $role = Session::get('admin_role');
        $nama = Session::get('admin_nama');

        // Statistik dasar (semua admin bisa lihat)
        $statArtikel = InfoPenyakit::count();
        $statPengguna = AccUser::where('role', 'user')->count();
        $statAdmin = AccUser::whereIn('role', ['superadmin', 'konten', 'pengguna', 'diagnosis'])->count();
        $statBaru = AccUser::whereDate('created_at', today())->count();

        // Statistik diagnosis (hanya untuk superadmin & diagnosis)
        $statDiagnosis = 0;
        $statPending = 0;
        $statCompleted = 0;
        $recentDiagnosis = collect();

        if (in_array($role, ['superadmin', 'diagnosis'])) {
            $statDiagnosis = HasilDiagnosis::count();
            $statPending = HasilDiagnosis::whereNull('nama_penyakit')->count();
            $statCompleted = HasilDiagnosis::whereNotNull('nama_penyakit')->count();
            $recentDiagnosis = HasilDiagnosis::with('user')->latest()->limit(5)->get();
        }

        // Data tabel berdasarkan role
        $admins = $role === 'superadmin' 
            ? AccUser::whereIn('role', ['superadmin', 'konten', 'pengguna', 'diagnosis'])->orderBy('nama')->limit(8)->get() 
            : collect();

        $users = in_array($role, ['superadmin', 'pengguna']) 
            ? AccUser::where('role', 'user')->latest()->limit(8)->get() 
            : collect();

        $artikel = in_array($role, ['superadmin', 'konten']) 
            ? InfoPenyakit::latest()->limit(8)->get() 
            : collect();

        return view('admin.dashboard', compact(
            'role', 'nama', 'statArtikel', 'statPengguna', 
            'statAdmin', 'statBaru',
            'statDiagnosis', 'statPending', 'statCompleted',
            'admins', 'users', 'artikel', 'recentDiagnosis'
        ));
    }
}