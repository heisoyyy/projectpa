<?php

namespace App\Http\Controllers\juri;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Team;
use App\Models\Member;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;

class JuriController extends Controller
{
    public function index()
    {
        // Jumlah seluruh peserta
        $jumlahPeserta = Member::where('role', 'peserta')->count();

        // Jumlah seluruh tim
        $jumlahTim = Team::count();

        // List Data Tim (untuk dashboard)
        $teams = Team::with([
            'user', // sekolah
            'members' => function($q){
                $q->select('team_id', 'role');
            }
        ])->get();

        // Jadwal hari ini
        $jadwalHariIni = Jadwal::whereDate('tanggal', today())->get();

        // Profil Juri
        $profil = Auth::user();

        return view('juri.home-juri', compact(
            'jumlahPeserta',
            'jumlahTim',
            'teams',
            'jadwalHariIni',
            'profil'
        ));
    }
}
