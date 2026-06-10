<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function landing()
{
    return view('auth.landing');
}
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = AccUser::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user', $user->nama);
            return redirect('/dashboard');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    // Tampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:acc_users',
            'phone' => 'required',
            'email' => 'required|email|unique:acc_users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        AccUser::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Tampilkan dashboard
    public function dashboard()
    {
        if (!Session::get('user')) {
            return redirect('/login');
        }
        return view('auth.dashboard');
    }

    // Logout
    public function logout()
    {
        Session::forget('user');
        return redirect('/login');
    }
}