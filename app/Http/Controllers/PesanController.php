<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesan;
use App\Models\Team;

class PesanController extends Controller
{
    public function index()
    {
        $pesans = Pesan::latest()->get();
        $teams  = Team::with('user')->get();

        return view('admin.pesan-admin', compact('pesans', 'teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'isi'    => 'required|string',
            'tujuan' => 'required|array',
        ]);

        $tujuan = in_array('all', $request->tujuan)
            ? 'all'
            : implode(',', $request->tujuan);

        Pesan::create([
            'judul'  => $request->judul,
            'isi'    => $request->isi,
            'tujuan' => $tujuan
        ]);

        return redirect()->route('admin.pesan.index')->with('success', 'Pesan berhasil dikirim.');
    }

    public function destroy(Pesan $pesan)
    {
        $pesan->delete();
        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
