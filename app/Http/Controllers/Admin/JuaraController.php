<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homepage\Juara;
use Illuminate\Http\Request;

class JuaraController extends Controller
{
    public function index()
    {
        $juaras = Juara::orderBy('tahun', 'desc')->get();
        return view('admin.juara.index', compact('juaras'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun' => 'required|integer',
            'juara' => 'required|integer',
            'nama_sekolah' => 'required|string',
            'pelatih' => 'required|string',
            'jumlah_tim' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('juara', 'public');
        }

        Juara::create($data);
        return back()->with('success', 'Juara berhasil ditambahkan!');
    }

    public function update(Request $request, Juara $juara)
    {
        $data = $request->validate([
            'tahun' => 'required|integer',
            'juara' => 'required|integer',
            'nama_sekolah' => 'required|string',
            'pelatih' => 'required|string',
            'jumlah_tim' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('juara', 'public');
        }

        $juara->update($data);
        return back()->with('success', 'Juara berhasil diupdate!');
    }

    public function destroy(Juara $juara)
    {
        $juara->delete();
        return back()->with('success', 'Juara berhasil dihapus!');
    }
}
