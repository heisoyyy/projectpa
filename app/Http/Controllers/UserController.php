<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    public function pesanIndex()
    {
        $team = auth()->user()->team;

        if (!$team) {
            // kalau user belum punya tim, return paginator kosong
            $pesans = new LengthAwarePaginator([], 0, 10);
            } else {
                $pesans = Pesan::forTeam($team->id)
                    ->latest()
                    ->paginate(10);
            }

        return view('user.pesan.user-pesan', compact('pesans'));
    }

    public function pesanRead($id)
    {
        $user = auth()->user();

        // Ambil pesan hanya jika ditujukan ke user ini
        $pesan = Pesan::forUser($user)
            ->where('id', $id)
            ->firstOrFail();

        return view('user.pesan.pesan-detail', compact('pesan'));
    }
}
