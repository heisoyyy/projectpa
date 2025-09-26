<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Team;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    /**
     * Halaman Admin - lihat semua hasil
     */
    public function index()
    {
        // Ambil semua team (buat dropdown pilih sekolah)
        $teams = Team::with('user')->get();

        // Ambil semua hasil, urut berdasarkan total desc
        $hasils = Hasil::with('team.user')
            ->orderByDesc('total')
            ->get();

        return view('admin.hasil-admin', compact('teams', 'hasils'));
    }

    /**
     * Simpan hasil baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'team_id'       => 'required|exists:teams,id',
            'nilai_baris'   => 'required|integer|min:0|max:100',
            'nilai_variasi' => 'required|integer|min:0|max:100',
            'nilai_formasi' => 'required|integer|min:0|max:100',
            'nilai_kompak'  => 'required|integer|min:0|max:100',
            'catatan'       => 'nullable|string',
        ]);

        $total = ($request->nilai_baris + $request->nilai_variasi + $request->nilai_formasi + $request->nilai_kompak) / 4;

        Hasil::create([
            'team_id'       => $request->team_id,
            'nilai_baris'   => $request->nilai_baris,
            'nilai_variasi' => $request->nilai_variasi,
            'nilai_formasi' => $request->nilai_formasi,
            'nilai_kompak'  => $request->nilai_kompak,
            'total'         => $total,
            'catatan'       => $request->catatan,
            'is_published'  => false, // default belum dipublish
        ]);

        return redirect()->route('admin.hasil-admin.index')->with('success', 'Nilai berhasil disimpan ✅');
    }

    /**
     * Update hasil
     */
    public function update(Request $request, Hasil $hasil)
    {
        $request->validate([
            'nilai_baris'   => 'required|integer|min:0|max:100',
            'nilai_variasi' => 'required|integer|min:0|max:100',
            'nilai_formasi' => 'required|integer|min:0|max:100',
            'nilai_kompak'  => 'required|integer|min:0|max:100',
            'catatan'       => 'nullable|string',
        ]);

        $total = ($request->nilai_baris + $request->nilai_variasi + $request->nilai_formasi + $request->nilai_kompak) / 4;

        $hasil->update([
            'nilai_baris'   => $request->nilai_baris,
            'nilai_variasi' => $request->nilai_variasi,
            'nilai_formasi' => $request->nilai_formasi,
            'nilai_kompak'  => $request->nilai_kompak,
            'total'         => $total,
            'catatan'       => $request->catatan,
        ]);

        return redirect()->route('admin.hasil-admin.index')->with('success', 'Nilai berhasil diperbarui ✏️');
    }

    /**
     * Hapus hasil
     */
    public function destroy(Hasil $hasil)
    {
        $hasil->delete();

        return redirect()->route('admin.hasil-admin.index')
            ->with('success', 'Nilai berhasil dihapus 🗑️');
    }

    /**
     * Halaman user - lihat hasil yang dipublish
     */
    public function hasilPeserta()
    {
        // Ambil hasil yang sudah dipublish saja
        $hasil = Hasil::with('team.user')
            ->where('is_published', true)
            ->orderByDesc('total')
            ->get();

        // Ranking otomatis
        $ranking = 1;
        foreach ($hasil as $row) {
            $row->peringkat = $ranking++;
        }

        // Ambil team user yang login
        $userTeam = auth()->user()->team ?? null;

        return view('user.hasil-user', compact('hasil', 'userTeam'));
    }

    /**
     * Publish hasil
     */
    public function publish($id)
    {
        $hasil = Hasil::findOrFail($id);
        $hasil->update([
            'is_published' => true
        ]);

        return redirect()->back()->with('success', 'Hasil berhasil dipublish 🎉');
    }

    /**
     * Unpublish hasil
     */
    public function unpublish($id)
    {
        $hasil = Hasil::findOrFail($id);
        $hasil->update([
            'is_published' => false
        ]);

        return redirect()->back()->with('success', 'Hasil berhasil disembunyikan ❌');
    }
    public function publishAll()
    {
        Hasil::query()->update(['is_published' => true]);

        return redirect()->back()->with('success', 'Semua hasil berhasil di-share 🎉');
    }
    public function unpublishAll()
    {
        Hasil::query()->update(['is_published' => false]);

        return redirect()->back()->with('success', 'Semua hasil berhasil disembunyikan ❌');
    }
}
