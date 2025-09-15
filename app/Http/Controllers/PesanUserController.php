<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesan;
use Illuminate\Support\Facades\Auth;

class PesanUserController extends Controller
{
    public function index()
    {
        $teamId = Auth::user()->team->id;

        $pesans = Pesan::where('tujuan', 'all')
            ->orWhere(function ($q) use ($teamId) {
                $q->whereRaw("FIND_IN_SET(?, tujuan)", [$teamId]);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.pesan-user', compact('pesans'));
    }

    public function show(Pesan $pesan)
    {
        return view('user.pesan-detail', compact('pesan'));
    }

    // Opsional biar route lama gak error
    public function markAllRead()
    {
        return back()->with('success', 'Semua pesan dianggap sudah dibaca.');
    }

    public function markRead(Pesan $pesan)
    {
        return back()->with('success', "Pesan '{$pesan->judul}' dianggap sudah dibaca.");
    }
}
