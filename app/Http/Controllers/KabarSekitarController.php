<?php
// app/Http/Controllers/KabarSekitarController.php

namespace App\Http\Controllers;

use App\Models\KabarSekitar;
use App\Models\RiwayatPrediksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KabarSekitarController extends Controller
{
    public function index()
    {
        if (!Session::get('user_id')) {
            return redirect('/login');
        }

        // Ambil kota terakhir dari prediksi user
        $lastPrediction = RiwayatPrediksi::where('user_id', Session::get('user_id'))
            ->latest()
            ->first();

        $kotaTerakhir = $lastPrediction ? $lastPrediction->kota : '';

        // Ambil semua kabar (sortir terbaru)
        $semuaKabar = KabarSekitar::with('user')
            ->latest()
            ->get();

        return view('auth.kabarsekitar', [
            'namaUser' => Session::get('user'),
            'kotaTerakhir' => $kotaTerakhir,
            'semuaKabar' => $semuaKabar,
        ]);
    }

    public function store(Request $request)
    {
        if (!Session::get('user_id')) {
            return redirect('/login');
        }

        $request->validate([
            'kota' => 'required|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:500',
        ]);

        KabarSekitar::create([
            'user_id' => Session::get('user_id'),
            'kota' => $request->kota,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Kabar berhasil dikirim!');
    }
}