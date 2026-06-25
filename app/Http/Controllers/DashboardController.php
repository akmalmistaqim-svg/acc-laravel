<?php

namespace App\Http\Controllers;

use App\Services\BpsService;
use App\Services\CuacaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    protected BpsService $bpsService;
    protected CuacaService $cuacaService;

    public function __construct(BpsService $bpsService, CuacaService $cuacaService)
    {
        $this->bpsService = $bpsService;
        $this->cuacaService = $cuacaService;
    }

    public function index()
    {
        if (!Session::get('user')) {
            return redirect('/login');
        }

        $iklim = $this->bpsService->getStaticTable('3500', '2303');
        $daftarKota = $this->cuacaService->getDaftarKota();

        return view('auth.dashboard', [
            'iklim' => $iklim,
            'daftarKota' => $daftarKota,
            'namaUser' => Session::get('user'),
        ]);
    }

    /**
     * API: Ambil data cuaca berdasarkan kota
     */
    public function getCuaca(Request $request)
    {
        $kota = $request->query('kota');
        
        if (empty($kota)) {
            return response()->json(['error' => 'Kota tidak boleh kosong'], 400);
        }

        $data = $this->cuacaService->getForecast($kota);
        
        if (isset($data['error'])) {
            return response()->json($data, 404);
        }

        return response()->json($data);
    }

    /**
     * API: Ambil data iklim BPS
     */
    public function getIklim()
    {
        $data = $this->bpsService->getStaticTable('3500', '2303');
        return response()->json($data);
    }

    /**
     * API: Ambil daftar kota
     */
    public function getDaftarKota()
    {
        return response()->json($this->cuacaService->getDaftarKota());
    }
}