<?php

namespace App\Http\Controllers\juri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hasil;
use App\Models\Team;

class NilaiJuriController extends Controller
{
    public function index()
    {
        $teams = Team::with('user')->get();

        $hasils = Hasil::with('team.user')
            ->orderByDesc('total')
            ->get();

        return view('juri.hasil-juri', compact('teams', 'hasils'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_id'       => 'required|exists:teams,id',
            'nilai_baris'   => 'required|numeric|min:0|max:100',
            'nilai_variasi' => 'required|numeric|min:0|max:100',
            'nilai_formasi' => 'required|numeric|min:0|max:100',
            'nilai_kompak'  => 'required|numeric|min:0|max:100',
            'catatan'       => 'nullable|string',
        ]);

        $total = (
            $request->nilai_baris +
            $request->nilai_variasi +
            $request->nilai_formasi +
            $request->nilai_kompak
        ) / 4;

        Hasil::create([
            'team_id'       => $request->team_id,
            'nilai_baris'   => $request->nilai_baris,
            'nilai_variasi' => $request->nilai_variasi,
            'nilai_formasi' => $request->nilai_formasi,
            'nilai_kompak'  => $request->nilai_kompak,
            'total'         => $total,
            'catatan'       => $request->catatan,
            'is_published'  => false,
        ]);

        return redirect()->route('juri.hasil-juri.index')
            ->with('success', 'Nilai berhasil disimpan ✅');
    }

    public function update(Request $request, Hasil $hasil)
    {
        $request->validate([
            'nilai_baris'   => 'required|numeric|min:0|max:100',
            'nilai_variasi' => 'required|numeric|min:0|max:100',
            'nilai_formasi' => 'required|numeric|min:0|max:100',
            'nilai_kompak'  => 'required|numeric|min:0|max:100',
            'catatan'       => 'nullable|string',
        ]);

        $total = (
            $request->nilai_baris +
            $request->nilai_variasi +
            $request->nilai_formasi +
            $request->nilai_kompak
        ) / 4;

        $hasil->update([
            'nilai_baris'   => $request->nilai_baris,
            'nilai_variasi' => $request->nilai_variasi,
            'nilai_formasi' => $request->nilai_formasi,
            'nilai_kompak'  => $request->nilai_kompak,
            'total'         => $total,
            'catatan'       => $request->catatan,
        ]);

        return redirect()->route('juri.hasil-juri.index')
            ->with('success', 'Nilai berhasil diperbarui ✏️');
    }

    public function destroy(Hasil $hasil)
    {
        $hasil->delete();

        return redirect()->route('juri.hasil-juri.index')
            ->with('success', 'Nilai berhasil dihapus 🗑️');
    }
}
