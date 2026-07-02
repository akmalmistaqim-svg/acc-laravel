<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoPenyakit extends Model
{
    // ⬇️ INI YANG PALING PENTING! ⬇️
    protected $table = 'info_penyakit';
    
    protected $fillable = [
        'judul',
        'url_artikel',
        'jenis_tanaman',
        'kategori',
        'deskripsi',
        'is_active',
        'created_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}