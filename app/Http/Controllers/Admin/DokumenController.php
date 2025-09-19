<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi\Dokumen;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'thumbnail' => 'nullable|image|max:10240',
            'file' => 'required|mimes:pdf|max:10240'
        ]);

        $dokumen = new Dokumen();
        $dokumen->judul = $request->judul;
        $dokumen->thumbnail = $request->file('thumbnail')?->store('public/dokumen');
        $dokumen->file = $request->file('file')->store('public/dokumen');
        $dokumen->save();

        return back()->with('success', 'Dokumen berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $request->validate([
            'judul' => 'required|string',
            'thumbnail' => 'nullable|image|max:10240',
            'file' => 'nullable|mimes:pdf|max:10240'
        ]);

        $dokumen->judul = $request->judul;

        if ($request->hasFile('thumbnail')) {
            if ($dokumen->thumbnail) Storage::delete($dokumen->thumbnail);
            $dokumen->thumbnail = $request->file('thumbnail')->store('public/dokumen');
        }

        if ($request->hasFile('file')) {
            if ($dokumen->file) Storage::delete($dokumen->file);
            $dokumen->file = $request->file('file')->store('public/dokumen');
        }

        $dokumen->save();
        return back()->with('success', 'Dokumen berhasil diperbarui');
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        if ($dokumen->thumbnail) Storage::delete($dokumen->thumbnail);
        if ($dokumen->file) Storage::delete($dokumen->file);
        $dokumen->delete();

        return back()->with('success', 'Dokumen berhasil dihapus');
    }
}
