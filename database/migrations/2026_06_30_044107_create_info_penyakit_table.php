<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPenyakit extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan model ini.
     * Migration membuat tabel 'info_penyakit' (singular),
     * jadi kita override konvensi default Eloquent (info_penyakits).
     */
    protected $table = 'info_penyakit';

    /**
     * Kolom yang boleh diisi secara mass assignment.
     */
    protected $fillable = [
        'judul',
        'url_artikel',
        'jenis_tanaman',
        'kategori',
        'deskripsi',
        'is_active',
        'created_by',
    ];

    /**
     * Casting tipe data kolom.
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];
}