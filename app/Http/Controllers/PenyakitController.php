<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\HasilDiagnosis;
use App\Models\InfoPenyakit; // <-- TAMBAHKAN INI

class PenyakitController extends Controller
{
    public function cekPenyakit()
    {
        if (!Session::get('user')) {
            return redirect('/login');
        }
        return view('auth.cekpenyakit', [
            'namaUser' => Session::get('user')
        ]);
    }

    public function infoPenyakit()
    {
        if (!Session::get('user')) {
            return redirect('/login');
        }
        
        // AMBIL DATA ARTIKEL DARI DATABASE
        $artikel = InfoPenyakit::where('is_active', true)
            ->latest()
            ->get();
        
        return view('auth.infopenyakit', [
            'namaUser' => Session::get('user'),
            'artikel' => $artikel, // <-- KIRIM KE VIEW
        ]);
    }

    public function hasilDiagnosa()
    {
        if (!Session::get('user')) {
            return redirect('/login');
        }

        $diagnosa = HasilDiagnosis::where('acc_user_id', Session::get('user_id'))
                    ->latest()
                    ->get();

        return view('auth.hasildiagnosa', [
            'namaUser' => Session::get('user'),
            'diagnosa' => $diagnosa,
        ]);
    }

    public function uploadFoto(Request $request)
    {
        if (!Session::get('user')) {
            return redirect('/login');
        }

        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $fotoPath = $request->file('foto')->store('diagnosis', 'public');

        HasilDiagnosis::create([
            'acc_user_id'       => Session::get('user_id'),
            'nama_penyakit'     => null,
            'analisis'          => null,
            'saran_penanganan'  => null,
            'foto'              => $fotoPath,
            'tanggal_diagnosis' => now()->toDateString(),
        ]);

        return redirect('/hasildiagnosa')->with('success', 'Foto berhasil dikirim! Tunggu hasil diagnosa dari admin.');
    }
}