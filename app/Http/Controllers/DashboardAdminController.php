<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Jadwal;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Total semua sekolah (jumlah team)
        $totalSekolah = Team::count();
        $pesertaTerverifikasi = Team::where('status', 'verified')->count();
        $jadwalHariIni = Jadwal::whereDate('tanggal', Carbon::today())->count();
        $pendaftaranTerakhir = Team::latest('created_at')->first();

        // Banyak jadwal yang jatuh pada hari ini
        $jadwalHariIni = Jadwal::whereBetween('tanggal', [
            Carbon::today()->startOfDay(),
            Carbon::today()->endOfDay(),
        ])->count();

        // Ambil data pendaftaran terakhir (team terbaru)
        $pendaftaranTerakhir = Team::orderBy('id', 'desc')->first();
        $waktuPendaftaranTerakhir = $pendaftaranTerakhir
            ? $pendaftaranTerakhir->created_at->diffForHumans()
            : '-';

        return view('admin.home-admin', compact(
            'totalSekolah',
            'jadwalHariIni',
            'waktuPendaftaranTerakhir'
        ));
    }
}
