<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        return view('auth.infopenyakit', [
            'namaUser' => Session::get('user')
        ]);
    }

    public function hasilDiagnosa()
    {
        if (!Session::get('user')) {
            return redirect('/login');
        }
        return view('auth.hasildiagnosa', [
            'namaUser' => Session::get('user')
        ]);
    }
}