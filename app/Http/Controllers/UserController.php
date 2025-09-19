<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

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
    public function cekDokumenStatus()
    {
        $user = Auth::user();
        $team = $user->team;

        $pesertaCount = $team ? $team->members->where('role', 'peserta')->count() : 0;
        $dokumen1Uploaded = $team ? $team->members->where('role', 'peserta')->whereNotNull('dokumen_1')->count() : 0;
        $dokumen2Uploaded = $team ? $team->members->where('role', 'peserta')->whereNotNull('dokumen_2')->count() : 0;
        $suratIzinUploaded = $user->foto_surat_izin ? true : false;

        $semuaLengkap = ($pesertaCount > 0 && $dokumen1Uploaded > 0 && $dokumen2Uploaded > 0 && $suratIzinUploaded);

        return response()->json([
            'semuaLengkap' => $semuaLengkap,
        ]);
    }
}
