<?php
// app/Http/Controllers/Admin/AdminArtikelController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfoPenyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminArtikelController extends Controller
{
    public function index()
    {
        $artikel = InfoPenyakit::latest()->get();
        $editData = null;
        
        if (request()->has('edit')) {
            $editData = InfoPenyakit::find(request()->edit);
        }
        
        return view('admin.artikel.index', compact('artikel', 'editData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'url_artikel' => 'required|url',
            'jenis_tanaman' => 'required|string|max:100',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        InfoPenyakit::create([
            'judul' => $request->judul,
            'url_artikel' => $request->url_artikel,
            'jenis_tanaman' => $request->jenis_tanaman,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'is_active' => true,
            'created_by' => Session::get('admin_username'),
        ]);

        return back()->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $artikel = InfoPenyakit::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'url_artikel' => 'required|url',
            'jenis_tanaman' => 'required|string|max:100',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $artikel->update([
            'judul' => $request->judul,
            'url_artikel' => $request->url_artikel,
            'jenis_tanaman' => $request->jenis_tanaman,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect('/admin/artikel')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $artikel = InfoPenyakit::findOrFail($id);
        $artikel->delete();

        return back()->with('success', 'Artikel berhasil dihapus!');
    }
}