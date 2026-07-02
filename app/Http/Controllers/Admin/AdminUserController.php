<?php
// app/Http/Controllers/Admin/AdminUserController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('cari');

        $users = AccUser::when($keyword, function($query, $keyword) {
            return $query->where('nama', 'like', "%{$keyword}%")
                        ->orWhere('username', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%");
        })->latest()->paginate(10);

        $total = AccUser::count();
        $baruHariIni = AccUser::whereDate('created_at', today())->count();

        return view('admin.users.index', compact('users', 'total', 'baruHariIni', 'keyword'));
    }

    public function destroy($id)
    {
        $user = AccUser::findOrFail($id);

        foreach ($user->hasilDiagnosis as $diagnosis) {
            if ($diagnosis->foto) {
                Storage::disk('public')->delete($diagnosis->foto);
            }
            $diagnosis->delete();
        }

        $user->delete();

        return back()->with('success', 'Pengguna berhasil dihapus!');
    }
}