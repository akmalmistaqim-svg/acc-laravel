<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BpsService
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.bps.api_key');
    }

    /**
     * Ambil data tabel statis BPS (data iklim) berdasarkan domain & id tabel.
     */
    public function getStaticTable(string $domain = '3500', string $id = '2303'): array
    {
        $url = "https://webapi.bps.go.id/v1/api/view/domain/{$domain}/model/statictable/lang/ind/id/{$id}/key/{$this->apiKey}";

        $response = Http::timeout(30)->get($url);

        if ($response->failed()) {
            Log::error('BPS Static Table Failed', [
                'domain' => $domain,
                'id' => $id,
                'status' => $response->status()
            ]);
            return [
                'status' => 'error',
                'message' => 'Gagal mengambil data iklim',
            ];
        }

        $data = $response->json();

        if (!isset($data['data']['table'])) {
            Log::warning('BPS Static Table Not Found', [
                'domain' => $domain,
                'id' => $id,
                'response' => $data
            ]);
            return [
                'status' => 'error',
                'message' => 'Tabel iklim tidak ditemukan',
            ];
        }

        return [
            'status' => 'OK',
            'judul'  => $data['data']['title'] ?? 'Data Iklim Provinsi Jawa Timur',
            'tabel'  => html_entity_decode($data['data']['table']),
        ];
    }

    /**
     * Ambil daftar provinsi dari BPS
     */
    public function getDaftarProvinsi(): array
    {
        $url = "https://webapi.bps.go.id/v1/api/domain/type/all/prov/35/key/{$this->apiKey}";

        $response = Http::timeout(30)->get($url);

        if ($response->failed()) {
            return ['error' => 'Gagal mengambil data dari BPS'];
        }

        $data = $response->json();
        $list = $data['data'][1] ?? [];
        
        return array_values($list);
    }
}