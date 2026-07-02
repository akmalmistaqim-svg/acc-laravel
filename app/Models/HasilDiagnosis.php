<?php
// app/Models/HasilDiagnosis.php - TAMBAHKAN

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilDiagnosis extends Model
{
    protected $table = 'hasil_diagnosis';
    
    protected $fillable = [
        'acc_user_id',
        'nama_penyakit',
        'analisis',
        'saran_penanganan',
        'foto',
        'tanggal_diagnosis',
        'diagnosed_by', // TAMBAHKAN
        'diagnosed_at', // TAMBAHKAN
    ];

    // TAMBAHKAN RELASI
    public function user()
    {
        return $this->belongsTo(AccUser::class, 'acc_user_id');
    }

    public function isProcessed(): bool
    {
        return !is_null($this->nama_penyakit);
    }
}