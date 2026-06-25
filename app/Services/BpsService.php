<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

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

        $response = Http::get($url);

        if ($response->failed()) {
            return [
                'status' => 'error',
                'message' => 'Gagal mengambil data',
            ];
        }

        $data = $response->json();

        if (!isset($data['data']['table'])) {
            return [
                'status' => 'error',
                'message' => 'Tabel tidak ditemukan',
                'debug' => $data,
            ];
        }

        return [
            'status' => 'OK',
            'judul'  => $data['data']['title'] ?? 'Data Statistik',
            'tabel'  => html_entity_decode($data['data']['table']),
        ];
    }

    /**
     * Ambil daftar provinsi dari BPS
     */
    public function getDaftarProvinsi(): array
    {
        $url = "https://webapi.bps.go.id/v1/api/domain/type/all/prov/35/key/{$this->apiKey}";

        $response = Http::get($url);

        if ($response->failed()) {
            return ['error' => 'Gagal mengambil data dari BPS'];
        }

        $data = $response->json();

        // Filter hanya Jawa Timur (kode 35)
        $list = $data['data'][1] ?? [];
        $jatim = array_filter($list, function($item) {
            return strpos($item['domain_id'], '35') === 0;
        });

        return array_values($jatim);
    }
}