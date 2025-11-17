<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Team;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('team.user')->orderBy('urutan')->get();

        // Tim yang belum memiliki jadwal
        $teamBelumJadwal = Team::whereDoesntHave('jadwal')->get();

        return view('admin.jadwal-admin', compact('jadwals', 'teamBelumJadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'tempat' => 'required',
            'team_id' => 'required|exists:teams,id',
            'urutan' => 'required|integer',
        ]);

        Jadwal::create([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'team_id' => $request->team_id,
            'urutan' => $request->urutan,
        ]);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'tempat' => 'required',
            'team_id' => 'required|exists:teams,id',
            'urutan' => 'required|integer',
        ]);

        $jadwal = Jadwal::findOrFail($id);

        $jadwal->update([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'team_id' => $request->team_id,
            'urutan' => $request->urutan,
        ]);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
