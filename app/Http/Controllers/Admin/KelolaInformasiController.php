<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi\Informasi;
use App\Models\Informasi\Biodata;
use App\Models\Informasi\Dokumen;
use App\Models\Informasi\History;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class KelolaInformasiController extends Controller
{
    // Menampilkan halaman kelola informasi
    public function index()
    {
        $informasi = Informasi::first();
        $biodata   = Biodata::take(2)->get();
        $dokumen   = Dokumen::all();
        $history   = History::paginate(9);

        // ambil daftar sekolah dari user yang sudah daftar
        $sekolahs = \App\Models\User::select('nama_sekolah', 'kota')
            ->whereNotNull('nama_sekolah')
            ->whereNotNull('kota')
            ->distinct()
            ->get();

        return view('admin.kelola-informasi', compact('informasi', 'biodata', 'dokumen', 'history', 'sekolahs'));
    }

    // Update Hero Section
    public function updateHero(Request $request)
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
            if ($informasi->background) Storage::disk('public')->delete($informasi->background);
            $informasi->background = $request->file('background')->store('informasi', 'public');
        }

        $informasi->save();

        return back()->with('success', 'Hero section berhasil diperbarui');
    }

    // Update Biodata Kepala Sekolah / Ketua OSIS
    public function updateBiodata(Request $request, $id)
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
            if ($biodata->foto) Storage::disk('public')->delete($biodata->foto);
            $biodata->foto = $request->file('foto')->store('biodata', 'public');
        }

        $biodata->save();
        return back()->with('success', 'Biodata berhasil diperbarui');
    }

    // Tambah Dokumen
    public function storeDokumen(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'thumbnail' => 'nullable|image|max:10240',
            'file' => 'required|mimes:pdf|max:10240'
        ]);

        $dokumen = new Dokumen();
        $dokumen->judul = $request->judul;
        $dokumen->thumbnail = $request->file('thumbnail')?->store('dokumen', 'public');
        $dokumen->file = $request->file('file')->store('dokumen', 'public');
        $dokumen->save();

        return back()->with('success', 'Dokumen berhasil ditambahkan');
    }

    // Update Dokumen
    public function updateDokumen(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $request->validate([
            'judul' => 'required|string',
            'thumbnail' => 'nullable|image|max:10240',
            'file' => 'nullable|mimes:pdf|max:10240'
        ]);

        $dokumen->judul = $request->judul;

        if ($request->hasFile('thumbnail')) {
            if ($dokumen->thumbnail) Storage::disk('public')->delete($dokumen->thumbnail);
            $dokumen->thumbnail = $request->file('thumbnail')->store('dokumen', 'public');
        }

        if ($request->hasFile('file')) {
            if ($dokumen->file) Storage::disk('public')->delete($dokumen->file);
            $dokumen->file = $request->file('file')->store('dokumen', 'public');
        }

        $dokumen->save();
        return back()->with('success', 'Dokumen berhasil diperbarui');
    }

    // Hapus Dokumen
    public function deleteDokumen($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        if ($dokumen->thumbnail) Storage::disk('public')->delete($dokumen->thumbnail);
        if ($dokumen->file) Storage::disk('public')->delete($dokumen->file);
        $dokumen->delete();

        return back()->with('success', 'Dokumen berhasil dihapus');
    }

    // Tambah History Sekolah
    // Store History
    public function storeHistory(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string',
            'kota' => 'required|string',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|max:10240'
        ]);

        $history = new History();
        $history->nama_sekolah = $request->nama_sekolah;
        $history->kota = $request->kota;
        $history->deskripsi = $request->deskripsi;
        $history->image = $request->file('image')?->store('history', 'public');
        $history->save();

        return back()->with('success', 'History sekolah berhasil ditambahkan');
    }

    // Update History Sekolah
    public function updateHistory(Request $request, $id)
    {
        $history = History::findOrFail($id);
        $request->validate([
            'nama_sekolah' => 'required|string',
            'kota' => 'required|string',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|max:10240'
        ]);

        $history->nama_sekolah = $request->nama_sekolah;
        $history->kota = $request->kota;
        $history->deskripsi = $request->deskripsi;

        if ($request->hasFile('image')) {
            if ($history->image) Storage::disk('public')->delete($history->image);
            $history->image = $request->file('image')->store('history', 'public');
        }

        $history->save();
        return back()->with('success', 'History sekolah berhasil diperbarui');
    }

    // Hapus History Sekolah
    public function deleteHistory($id)
    {
        $history = History::findOrFail($id);
        if ($history->image) Storage::disk('public')->delete($history->image);
        $history->delete();

        return back()->with('success', 'History sekolah berhasil dihapus');
    }
}
