<?php

namespace App\Http\Controllers\juri;

use App\Models\Team;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class TimJuriController extends Controller
{
    // Daftar sekolah (semua tim)
    public function index()
    {
        $teams = Team::withCount(['pelatih', 'peserta'])->get();
        return view('juri.tim-sekolah', compact('teams'));
    }

    // Detail sekolah per tim
    public function detail($id)
    {
        $team = Team::with(['members', 'user'])->findOrFail($id);
        return view('juri.detail-sekolah', compact('team'));
    }
}
