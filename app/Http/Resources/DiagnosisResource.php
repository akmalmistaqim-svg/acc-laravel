<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiagnosisResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'acc_user_id'       => $this->acc_user_id,
            'nama_penyakit'     => $this->nama_penyakit,
            'analisis'          => $this->analisis,
            'saran_penanganan'  => $this->saran_penanganan,
            'foto'              => asset('storage/' . $this->foto),
            'tanggal_diagnosis'  => $this->tanggal_diagnosis,
            'created_at'        => $this->created_at,
        ];
    }
}