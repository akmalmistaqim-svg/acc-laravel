<?php
// app/Http/Middleware/AdminRoleMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AccUser;
use Illuminate\Support\Facades\Session;

class AdminRoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = AccUser::find(Session::get('user_id'));

        if (!$user) {
            return redirect('/login')->with('error', 'Sesi tidak valid.');
        }

        // Superadmin bisa akses semua
        if ($user->role === 'superadmin') {
            return $next($request);
        }

        // Cek apakah role user sesuai dengan yang diizinkan
        if (!in_array($user->role, $roles)) {
            return redirect('/admin/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}