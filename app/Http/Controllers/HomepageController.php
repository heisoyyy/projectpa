<?php

namespace App\Http\Controllers;

use App\Models\Homepage\Banner;
use App\Models\Homepage\Featured;
use App\Models\Homepage\Accordion;
use App\Models\Homepage\Video;
use App\Models\Homepage\Statistik;
use App\Models\Homepage\Juara;
use App\Models\Team;
use App\Models\Member;

class HomepageController extends Controller
{
    public function index()
    {
        $banners     = Banner::all();
        $featured    = Featured::first();
        $accordions  = Accordion::all();
        $videos      = Video::all();

        $statistik      = Statistik::first();
        $statistikJudul = $statistik ? $statistik->judul_section : 'LKBB Komando 2025';
        $statistiks     = Statistik::all();

        $juaras = Juara::all();

        // ── Statistik Dinamis ──────────────────────────────────────

        // 1. Tim Diterima = tim dgn status verified (sama persis dgn tabel admin)
        $timDiterima = Team::where('status', 'verified')->count();

        // 2. Jumlah Peserta = semua member role 'peserta' dari tim verified
        //    (pakai whereIn agar tidak tergantung relasi di Model Member)
        $verifiedTeamIds = Team::where('status', 'verified')->pluck('id');
        $jumlahPeserta   = Member::whereIn('team_id', $verifiedTeamIds)
                                 ->where('role', 'peserta')
                                 ->count();

        // 3. Tim Menunggu Jadwal = tim verified yang belum punya jadwal
        $timMenungguJadwal = Team::where('status', 'verified')
                                 ->doesntHave('jadwal')
                                 ->count();

        // ──────────────────────────────────────────────────────────

        return view('home.index', compact(
            'banners',
            'featured',
            'accordions',
            'videos',
            'statistikJudul',
            'statistiks',
            'juaras',
            'timDiterima',
            'jumlahPeserta',
            'timMenungguJadwal'
        ));
    }
}