<?php
// app/Http/Controllers/RiwayatPrediksiController.php

namespace App\Http\Controllers;

use App\Models\RiwayatPrediksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RiwayatPrediksiController extends Controller
{
    public function index()
    {
        if (!Session::get('user_id')) {
            return redirect('/login');
        }

        // Ambil semua riwayat prediksi dari semua user (sortir terbaru)
        $riwayat = RiwayatPrediksi::with('user')
            ->latest()
            ->paginate(10);

        return view('auth.riwayatprediksi', [
            'namaUser' => Session::get('user'),
            'riwayat' => $riwayat,
        ]);
    }

    // Simpan prediksi otomatis (dipanggil dari dashboard setelah user cek prediksi)
    public static function simpanPrediksi($userId, $kota, $suhu, $kondisi, $icon, $tanggalPrediksi)
    {
        RiwayatPrediksi::create([
            'user_id' => $userId,
            'kota' => $kota,
            'suhu' => $suhu,
            'kondisi' => $kondisi,
            'icon' => $icon,
            'tanggal_prediksi' => $tanggalPrediksi,
        ]);
    }
}