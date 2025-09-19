<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi\Informasi;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    // Tampilkan halaman kelola informasi
    public function index()
    {
        $informasi = Informasi::first();
        $biodata   = \App\Models\Informasi\Biodata::take(2)->get();
        $dokumen   = \App\Models\Informasi\Dokumen::all();
        $history   = \App\Models\Informasi\History::paginate(9);

        return view('admin.kelola-informasi', compact('informasi', 'biodata', 'dokumen', 'history'));
    }

    // Update Hero
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'background' => 'nullable|image|max:10240'
        ]);

        $informasi = Informasi::first() ?? new Informasi();
        $informasi->title = $request->title;
        $informasi->description = $request->description;

        if ($request->hasFile('background')) {
            if ($informasi->background) Storage::delete($informasi->background);
            $informasi->background = $request->file('background')->store('public/hero');
        }

        $informasi->save();

        return back()->with('success', 'Hero section berhasil diperbarui');
    }
}
