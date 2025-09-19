<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi\Biodata;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    public function update(Request $request, $id)
    {
        $biodata = Biodata::findOrFail($id);

        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:10240'
        ]);

        $biodata->nama = $request->nama;
        $biodata->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto')) {
            if ($biodata->foto) Storage::delete($biodata->foto);
            $biodata->foto = $request->file('foto')->store('public/biodata');
        }

        $biodata->save();

        return back()->with('success', 'Biodata berhasil diperbarui');
    }
}
