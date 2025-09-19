<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi\History;
use Illuminate\Support\Facades\Storage;

class HistoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string',
            'kota' => 'required|string',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $history = new History();
        $history->nama_sekolah = $request->nama_sekolah;
        $history->kota = $request->kota;
        $history->deskripsi = $request->deskripsi;
        $history->image = $request->file('image')?->store('public/history');
        $history->save();

        return back()->with('success', 'History sekolah berhasil ditambahkan');
    }

    public function update(Request $request, $id)
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
            if ($history->image) Storage::delete($history->image);
            $history->image = $request->file('image')->store('public/history');
        }

        $history->save();
        return back()->with('success', 'History sekolah berhasil diperbarui');
    }

    public function destroy($id)
    {
        $history = History::findOrFail($id);
        if ($history->image) Storage::delete($history->image);
        $history->delete();

        return back()->with('success', 'History sekolah berhasil dihapus');
    }
}
