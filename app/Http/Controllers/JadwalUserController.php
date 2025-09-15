<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;


class JadwalUserController extends Controller
{
    public function index()
    {
        // default supaya view tidak dapat undefined variable
        $jadwal  = null;
        $sebelum = null;
        $sesudah = null;

        $user = Auth::user();

        // kalau tidak login / tidak ada team, tetap kirim null
        if ($user) {
            $team = $user->team; // pastikan relasi User->team ada di model User

            if ($team) {
                // pastikan relasi team->jadwal ada di model Team:
                // public function jadwal() { return $this->hasOne(Jadwal::class); }

                $team->load('jadwal'); // eager load (aman)
                $jadwal = $team->jadwal; // bisa null kalau belum dijadwalkan

                if ($jadwal) {
                    // cari urutan langsung sebelum dan sesudah
                    $sebelum = Jadwal::where('urutan', '<', $jadwal->urutan)
                                     ->orderBy('urutan', 'desc')
                                     ->first();

                    $sesudah = Jadwal::where('urutan', '>', $jadwal->urutan)
                                     ->orderBy('urutan', 'asc')
                                     ->first();
                }
            }
        }

        return view('user.jadwal-user', compact('jadwal', 'sebelum', 'sesudah'));
    }
}
