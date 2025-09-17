<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use App\Models\Pesan;
use App\Models\Team;

class DashboardUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $team = $user->team; // ambil tim user

        $jadwal = $sebelum = $sesudah = null;

        if ($team) {
            $jadwal = Jadwal::where('team_id', $team->id)->first();

            if ($jadwal) {
                $sebelum = Jadwal::where('tanggal', $jadwal->tanggal)
                    ->where('urutan', '<', $jadwal->urutan)
                    ->orderBy('urutan', 'desc')
                    ->first();

                $sesudah = Jadwal::where('tanggal', $jadwal->tanggal)
                    ->where('urutan', '>', $jadwal->urutan)
                    ->orderBy('urutan', 'asc')
                    ->first();
            }
        }

        $pengumuman = Pesan::where(function ($q) use ($team) {
            $q->where('tujuan', 'all');

            if ($team) {
                $q->orWhereRaw("FIND_IN_SET(?, tujuan)", [$team->id]);
            }
        })
            ->latest()
            ->take(5)
            ->get();

        // kirim $team ke view supaya bisa ditampilkan statusnya
        return view('user.home-user', compact('user', 'team', 'jadwal', 'sebelum', 'sesudah', 'pengumuman'));
    }

    public function showTeamStatus($id)
    {
        $team = Team::findOrFail($id); // ambil data tim
        return view('user.status', compact('team')); // kirim ke view
    }
}
