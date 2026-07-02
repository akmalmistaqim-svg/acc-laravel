<?php
// app/Http/Controllers/Admin/AdminDiagnosisController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilDiagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminDiagnosisController extends Controller
{
    public function index(Request $request)
    {
        $query = HasilDiagnosis::with('user');

        // Filter status
        if ($request->has('status')) {
            if ($request->status === 'pending') {
                $query->whereNull('nama_penyakit');
            } elseif ($request->status === 'completed') {
                $query->whereNotNull('nama_penyakit');
            }
        }

        // Pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_penyakit', 'like', "%{$search}%")
                  ->orWhereHas('user', function($u) use ($search) {
                      $u->where('nama', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }

        $diagnosis = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Stats
        $total = HasilDiagnosis::count();
        $pending = HasilDiagnosis::whereNull('nama_penyakit')->count();
        $completed = HasilDiagnosis::whereNotNull('nama_penyakit')->count();

        return view('admin.diagnosis.index', compact('diagnosis', 'total', 'pending', 'completed'));
    }

    public function process($id)
    {
        $diagnosis = HasilDiagnosis::with('user')->findOrFail($id);
        return view('admin.diagnosis.process', compact('diagnosis'));
    }

    public function processStore(Request $request, $id)
    {
        $diagnosis = HasilDiagnosis::findOrFail($id);

        $request->validate([
            'nama_penyakit' => 'required|string|max:255',
            'analisis' => 'required|string',
            'saran_penanganan' => 'required|string',
        ]);

        $diagnosis->update([
            'nama_penyakit' => $request->nama_penyakit,
            'analisis' => $request->analisis,
            'saran_penanganan' => $request->saran_penanganan,
            'tanggal_diagnosis' => now()->toDateString(),
            'diagnosed_by' => Session::get('admin_nama'),
            'diagnosed_at' => now(),
        ]);

        return redirect('/admin/diagnosis')->with('success', 'Diagnosis berhasil diproses!');
    }

    public function destroy($id)
    {
        $diagnosis = HasilDiagnosis::findOrFail($id);
        
        if ($diagnosis->foto) {
            Storage::disk('public')->delete($diagnosis->foto);
        }
        
        $diagnosis->delete();
        
        return back()->with('success', 'Diagnosis berhasil dihapus!');
    }

    public function export($id)
    {
        $diagnosis = HasilDiagnosis::with('user')->findOrFail($id);
        
        // Return view untuk print
        return view('admin.diagnosis.export', compact('diagnosis'));
    }
}