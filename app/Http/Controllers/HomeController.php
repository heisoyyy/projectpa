<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesan;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil pesan untuk user ini
        $pesans = Pesan::where(function($q) use ($user) {
            $q->where('tujuan','all')
              ->orWhereRaw("FIND_IN_SET(?, tujuan)", [$user->team_id]);
        })->orderByDesc('created_at')->get();

        return view('user.home', compact('user', 'pesans'));
    }
}
