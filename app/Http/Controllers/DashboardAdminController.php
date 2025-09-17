<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Activity;
use App\Models\Jadwal;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalSekolah = Team::count();
        $verifiedCount = Team::where('status', 'verified')
            ->withCount(['members as peserta_count' => function ($q) {
                $q->where('role', 'peserta');
            }])
            ->get()
            ->sum('peserta_count');

        $pesertaPerSekolah = Team::withCount(['members as peserta_count' => function ($q) {
            $q->where('role', 'peserta');
        }])->get();

        $labelsSekolah = $pesertaPerSekolah->pluck('nama_tim');
        $dataPeserta = $pesertaPerSekolah->pluck('peserta_count');

        $statusCounts = [
            'verified' => Team::where('status', 'verified')->count(),
            'pending' => Team::where('status', 'pending')->count(),
        ];

        $jadwalHariIni = Jadwal::whereBetween('tanggal', [
            Carbon::today()->startOfDay(),
            Carbon::today()->endOfDay(),
        ])->count();

        $pendaftaranTerakhir = Team::latest('id')->first();
        $waktuPendaftaranTerakhir = $pendaftaranTerakhir
            ? $pendaftaranTerakhir->created_at->diffForHumans()
            : '-';

        // 🔥 Ambil 3 aktivitas terakhir
        $latestActivities = Activity::with('team')->latest()->take(3)->get();

        return view('admin.home-admin', compact(
            'totalSekolah',
            'verifiedCount',
            'jadwalHariIni',
            'waktuPendaftaranTerakhir',
            'labelsSekolah',
            'dataPeserta',
            'statusCounts',
            'latestActivities' // dikirim ke view
        ));
    }
}
