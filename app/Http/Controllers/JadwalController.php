<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('team.user')->orderBy('urutan')->get();
        $sekolahBelumJadwal = Team::whereDoesntHave('jadwal')->with('user')->get();
        return view('admin.jadwal-admin', compact('jadwals','sekolahBelumJadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'tempat' => 'required',
            'sekolah_id' => 'required|exists:teams,id',
            'urutan' => 'required|integer',
        ]);

        Jadwal::create([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'team_id' => $request->sekolah_id,
            'urutan' => $request->urutan,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success','Jadwal berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();
        return back()->with('success','Jadwal berhasil dihapus.');
    }
}
