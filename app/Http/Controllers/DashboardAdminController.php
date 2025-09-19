<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Activity;
use App\Models\Jadwal;
use App\Models\Setting;
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

        $latestActivities = Activity::with('team')->latest()->take(3)->get();

        // ambil setting pendaftaran
        $setting = Setting::firstOrCreate(
            ['key' => 'pendaftaran_enabled'],
            ['value' => '1'] // default aktif
        );

        return view('admin.home-admin', compact(
            'totalSekolah',
            'verifiedCount',
            'jadwalHariIni',
            'waktuPendaftaranTerakhir',
            'labelsSekolah',
            'dataPeserta',
            'statusCounts',
            'latestActivities',
            'setting'
        ));
    }

    public function togglePendaftaran(Request $request)
    {
        $setting = Setting::firstOrCreate(
            ['key' => 'pendaftaran_enabled'],
            ['value' => '1']
        );

        $setting->value = $setting->value == '1' ? '0' : '1';
        $setting->save();

        return back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }
}
