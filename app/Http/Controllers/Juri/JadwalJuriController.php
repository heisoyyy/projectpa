<?php

namespace App\Http\Controllers\juri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Team;

class JadwalJuriController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('team.user')->orderBy('urutan')->get();

        // Tim yang belum memiliki jadwal
        $teamBelumJadwal = Team::whereDoesntHave('jadwal')->get();

        return view('juri.jadwal-juri', compact('jadwals', 'teamBelumJadwal'));
    }
}
