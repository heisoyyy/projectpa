<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homepage\Statistik;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function updateJudul(Request $request)
    {
        $statistik = Statistik::first();
        $data = $request->validate([
            'judul_section' => 'required|string'
        ]);

        if ($statistik) {
            $statistik->update($data);
        } else {
            Statistik::create($data);
        }

        return back()->with('success', 'Judul Statistik berhasil diupdate!');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label' => 'required|string',
            'jumlah' => 'required|integer'
        ]);

        Statistik::create($data);
        return back()->with('success', 'Statistik berhasil ditambahkan!');
    }

    public function update(Request $request, Statistik $statistik)
    {
        $data = $request->validate([
            'label' => 'required|string',
            'jumlah' => 'required|integer'
        ]);

        $statistik->update($data);
        return back()->with('success', 'Statistik berhasil diupdate!');
    }

    public function destroy(Statistik $statistik)
    {
        $statistik->delete();
        return back()->with('success', 'Statistik berhasil dihapus!');
    }
}
