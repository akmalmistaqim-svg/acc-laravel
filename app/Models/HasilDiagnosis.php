<?php
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
    ];
}