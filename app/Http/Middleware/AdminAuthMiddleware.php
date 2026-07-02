<?php
// app/Http/Middleware/AdminAuthMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\AccUser;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::get('user_id')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = AccUser::find(Session::get('user_id'));

        if (!$user || !in_array($user->role, ['superadmin', 'konten', 'pengguna', 'diagnosis'])) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke Admin Panel.');
        }

        // Pastikan session admin terisi
        if (!Session::get('admin_role')) {
            Session::put('admin_id', $user->id);
            Session::put('admin_nama', $user->nama);
            Session::put('admin_role', $user->role);
            Session::put('admin_username', $user->username);
        }

        return $next($request);
    }
}