<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CuacaService
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openweather.api_key');
    }

    /**
     * Ambil data cuaca 5 hari ke depan berdasarkan kota
     */
    public function getForecast(string $kota): array
    {
        if (empty($kota)) {
            return ['error' => 'Kota tidak boleh kosong'];
        }

        $url = "https://api.openweathermap.org/data/2.5/forecast?q={$kota},ID&appid={$this->apiKey}&units=metric&lang=id";

        $response = Http::get($url);

        if ($response->failed()) {
            return ['error' => 'Gagal mengambil data cuaca'];
        }

        $data = $response->json();

        if ($data['cod'] != "200") {
            return ['error' => 'Kota tidak ditemukan'];
        }

        return $data;
    }

    /**
     * Ambil daftar kota di Jawa Timur
     */
    public function getDaftarKota(): array
    {
        return [
            ['value' => 'Surabaya', 'label' => 'Surabaya'],
            ['value' => 'Malang', 'label' => 'Malang'],
            ['value' => 'Kediri', 'label' => 'Kediri'],
            ['value' => 'Madiun', 'label' => 'Madiun'],
            ['value' => 'Blitar', 'label' => 'Blitar'],
            ['value' => 'Mojokerto', 'label' => 'Mojokerto'],
            ['value' => 'Pasuruan', 'label' => 'Pasuruan'],
            ['value' => 'Probolinggo', 'label' => 'Probolinggo'],
            ['value' => 'Batu', 'label' => 'Batu'],
            ['value' => 'Jember', 'label' => 'Jember'],
            ['value' => 'Banyuwangi', 'label' => 'Banyuwangi'],
            ['value' => 'Bondowoso', 'label' => 'Bondowoso'],
            ['value' => 'Situbondo', 'label' => 'Situbondo'],
            ['value' => 'Lumajang', 'label' => 'Lumajang'],
            ['value' => 'Sidoarjo', 'label' => 'Sidoarjo'],
            ['value' => 'Gresik', 'label' => 'Gresik'],
            ['value' => 'Lamongan', 'label' => 'Lamongan'],
            ['value' => 'Tuban', 'label' => 'Tuban'],
            ['value' => 'Bojonegoro', 'label' => 'Bojonegoro'],
            ['value' => 'Ngawi', 'label' => 'Ngawi'],
            ['value' => 'Magetan', 'label' => 'Magetan'],
            ['value' => 'Ponorogo', 'label' => 'Ponorogo'],
            ['value' => 'Pacitan', 'label' => 'Pacitan'],
            ['value' => 'Trenggalek', 'label' => 'Trenggalek'],
            ['value' => 'Tulungagung', 'label' => 'Tulungagung'],
            ['value' => 'Jombang', 'label' => 'Jombang'],
            ['value' => 'Nganjuk', 'label' => 'Nganjuk'],
            ['value' => 'Bangkalan', 'label' => 'Bangkalan'],
            ['value' => 'Sampang', 'label' => 'Sampang'],
            ['value' => 'Pamekasan', 'label' => 'Pamekasan'],
            ['value' => 'Sumenep', 'label' => 'Sumenep'],
        ];
    }
}