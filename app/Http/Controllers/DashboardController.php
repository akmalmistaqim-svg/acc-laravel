<?php

namespace App\Http\Controllers;

use App\Services\BpsService;
use App\Services\CuacaService;
use App\Models\RiwayatPrediksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

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

        // Ambil data iklim
        $iklim = $this->bpsService->getStaticTable('3500', '2303');
        
        // Ambil daftar kota untuk dropdown
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

    /**
     * API: Simpan riwayat prediksi
     */
    public function simpanRiwayat(Request $request)
    {
        if (!Session::get('user_id')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $request->validate([
                'kota' => 'required|string|max:100',
                'suhu' => 'required|integer',
                'kondisi' => 'nullable|string|max:100',
                'icon' => 'nullable|string|max:10',
                'tanggal_prediksi' => 'required|date',
            ]);

            $riwayat = RiwayatPrediksi::create([
                'user_id' => Session::get('user_id'),
                'kota' => $request->kota,
                'suhu' => $request->suhu,
                'kondisi' => $request->kondisi,
                'icon' => $request->icon,
                'tanggal_prediksi' => $request->tanggal_prediksi,
            ]);

            Log::info('Riwayat prediksi tersimpan', [
                'user_id' => Session::get('user_id'),
                'kota' => $request->kota,
                'suhu' => $request->suhu
            ]);

            return response()->json([
                'message' => 'Riwayat tersimpan',
                'data' => $riwayat
            ]);
            
        } catch (\Exception $e) {
            Log::error('Gagal simpan riwayat prediksi', [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);
            
            return response()->json([
                'error' => 'Gagal menyimpan riwayat: ' . $e->getMessage()
            ], 500);
        }
    }
}