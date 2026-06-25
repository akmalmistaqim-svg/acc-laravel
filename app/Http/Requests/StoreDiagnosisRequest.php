<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiagnosisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_penyakit'     => 'required|string|max:255',
            'analisis'          => 'required|string',
            'saran_penanganan'  => 'required|string',
            'foto'              => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}