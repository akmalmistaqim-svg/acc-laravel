<?php
namespace App\Http\Controllers;

use App\Models\HasilDiagnosis;
use App\Http\Requests\StoreDiagnosisRequest;
use App\Http\Resources\DiagnosisResource;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class DiagnosisController extends Controller
{
    public function index(Request $request)
    {
        $query = HasilDiagnosis::query();

        if ($request->has('nama_penyakit')) {
            $query->where('nama_penyakit', 'like', '%' . $request->nama_penyakit . '%');
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tanggal_diagnosis', [
                $request->start_date,
                $request->end_date
            ]);
        }

        $data = $query->paginate(10);
        return DiagnosisResource::collection($data);
    }

    public function store(StoreDiagnosisRequest $request)
    {
        $fotoPath = $request->file('foto')->store('diagnosis', 'public');

        $diagnosis = HasilDiagnosis::create([
            'acc_user_id'       => auth()->id(),
            'nama_penyakit'     => $request->nama_penyakit,
            'analisis'          => $request->analisis,
            'saran_penanganan'  => $request->saran_penanganan,
            'foto'              => $fotoPath,
            'tanggal_diagnosis' => $request->tanggal_diagnosis,
        ]);

        return (new DiagnosisResource($diagnosis))
            ->additional(['message' => 'Diagnosis berhasil disimpan'])
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        try {
            $diagnosis = HasilDiagnosis::findOrFail($id);
            return new DiagnosisResource($diagnosis);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error'   => 'Resource tidak ditemukan',
                'message' => 'Data diagnosis dengan ID ' . $id . ' tidak ada.'
            ], 404);
        }
    }

    public function update(StoreDiagnosisRequest $request, $id)
    {
        try {
            $diagnosis = HasilDiagnosis::findOrFail($id);

            if ($request->hasFile('foto')) {
                Storage::disk('public')->delete($diagnosis->foto);
                $fotoPath = $request->file('foto')->store('diagnosis', 'public');
                $diagnosis->foto = $fotoPath;
            }

            $diagnosis->update([
                'nama_penyakit'     => $request->nama_penyakit,
                'analisis'          => $request->analisis,
                'saran_penanganan'  => $request->saran_penanganan,
                'foto'              => $diagnosis->foto,
                'tanggal_diagnosis' => $request->tanggal_diagnosis,
            ]);

            return (new DiagnosisResource($diagnosis))
                ->additional(['message' => 'Diagnosis berhasil diperbarui']);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error'   => 'Resource tidak ditemukan',
                'message' => 'Data diagnosis dengan ID ' . $id . ' tidak ada.'
            ], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $diagnosis = HasilDiagnosis::findOrFail($id);
            Storage::disk('public')->delete($diagnosis->foto);
            $diagnosis->delete();

            return response()->json([
                'message' => 'Diagnosis berhasil dihapus'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error'   => 'Resource tidak ditemukan',
                'message' => 'Data diagnosis dengan ID ' . $id . ' tidak ada.'
            ], 404);
        }
    }
}