<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Services\CuacaService;
use App\Services\BpsService;

class AuthController extends Controller
{
    protected CuacaService $cuacaService;
    protected BpsService $bpsService;

    public function __construct(CuacaService $cuacaService, BpsService $bpsService)
    {
        $this->cuacaService = $cuacaService;
        $this->bpsService = $bpsService;
    }

    public function landing()
    {
        return view('auth.landing');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->username;
        
        // Cari user berdasarkan username
        $user = AccUser::where('username', $username)->first();

        // Jika tidak ditemukan, coba case insensitive
        if (!$user) {
            $user = AccUser::whereRaw('LOWER(username) = ?', [strtolower($username)])->first();
        }

        if (!$user) {
            return back()
                ->with('error', 'User tidak ditemukan! Periksa kembali username Anda.')
                ->withInput($request->except('password'));
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah!');
        }

        // ==========================================
        // LOGIN BERHASIL
        // ==========================================
        
        $role = $user->role;

        // Cek apakah user adalah ADMIN
        if (in_array($role, ['superadmin', 'konten', 'pengguna', 'diagnosis'])) {
            
            // SET SESSION UNTUK ADMIN
            Session::put('user', $user->nama);
            Session::put('user_id', $user->id);
            Session::put('user_role', $role);
            
            // SET SESSION KHUSUS ADMIN
            Session::put('admin_id', $user->id);
            Session::put('admin_nama', $user->nama);
            Session::put('admin_role', $role);
            Session::put('admin_username', $user->username);

            return redirect('/admin/dashboard')->with('success', 'Selamat datang di Admin Panel, ' . $user->nama . '!');
        }

        // ========== USER BIASA ==========
        Session::put('user', $user->nama);
        Session::put('user_id', $user->id);
        Session::put('user_role', 'user');

        return redirect('/dashboard')->with('success', 'Selamat datang, ' . $user->nama . '!');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|unique:acc_users,username|max:50',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:acc_users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        AccUser::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function dashboard()
    {
        if (!Session::get('user_id')) {
            return redirect('/login');
        }

        $daftarKota = $this->cuacaService->getDaftarKota();
        $iklim = $this->bpsService->getStaticTable('3500', '2303');

        return view('auth.dashboard', [
            'namaUser' => Session::get('user'),
            'daftarKota' => $daftarKota,
            'iklim' => $iklim,
        ]);
    }

    public function logout()
    {
        Session::forget(['user', 'user_id', 'user_role', 'admin_id', 'admin_nama', 'admin_role', 'admin_username']);
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}