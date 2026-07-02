<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPrediksi extends Model
{
    protected $table = 'riwayat_prediksi';

    protected $fillable = [
        'user_id',
        'kota',
        'suhu',
        'kondisi',
        'icon',
        'tanggal_prediksi',
    ];

    protected $casts = [
        'suhu' => 'integer',
        'tanggal_prediksi' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(AccUser::class, 'user_id');
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->translatedFormat('d F Y, H:i');
    }

    public function getFormattedPrediksiDateAttribute()
    {
        return $this->tanggal_prediksi->translatedFormat('d F Y');
    }
}