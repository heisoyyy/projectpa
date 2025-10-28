<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function pesanIndex()
    {
        $user = auth()->user();
        $team = $user->team;

        if (!$team) {
            // kalau user belum punya tim, return paginator kosong
            $pesans = new LengthAwarePaginator([], 0, 10);
            $unreadCount = 0;
        } else {
            // Ambil semua pesan untuk team
            $allPesans = Pesan::forTeam($team->id)->get();
            
            // Hitung pesan yang belum dibaca (cek pivot table)
            $unreadCount = $allPesans->filter(function($pesan) use ($user) {
                $pivot = $pesan->receivers()->where('user_id', $user->id)->first();
                return !$pivot || !$pivot->pivot->is_read;
            })->count();
            
            // Sort berdasarkan status dibaca (belum dibaca di atas)
            $sortedPesans = $allPesans->sortByDesc(function($pesan) use ($user) {
                $pivot = $pesan->receivers()->where('user_id', $user->id)->first();
                $isRead = $pivot ? $pivot->pivot->is_read : false;
                // Return timestamp untuk secondary sort
                return [!$isRead, $pesan->created_at->timestamp];
            });
            
            // Pagination manual
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 10;
            $currentItems = $sortedPesans->slice(($currentPage - 1) * $perPage, $perPage)->values();
            
            $pesans = new LengthAwarePaginator(
                $currentItems,
                $sortedPesans->count(),
                $perPage,
                $currentPage,
                ['path' => LengthAwarePaginator::resolveCurrentPath()]
            );
        }

        return view('user.pesan.user-pesan', compact('pesans', 'unreadCount'));
    }

    public function pesanRead($id)
    {
        $user = auth()->user();
        $team = $user->team;

        if (!$team) {
            return redirect()->back()->with('error', 'Anda belum terdaftar dalam tim.');
        }

        // Ambil pesan dan pastikan pesan tersebut untuk tim user
        $pesan = Pesan::where('id', $id)
            ->where(function($query) use ($team) {
                $query->where('tujuan', 'all')
                      ->orWhereRaw("FIND_IN_SET(?, tujuan)", [$team->id]);
            })
            ->firstOrFail();

        // Cek apakah user sudah ada di pivot table
        $existingPivot = $pesan->receivers()->where('user_id', $user->id)->first();

        if (!$existingPivot) {
            // Jika belum ada, attach user dengan status dibaca
            $pesan->receivers()->attach($user->id, [
                'is_read' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } elseif (!$existingPivot->pivot->is_read) {
            // Jika sudah ada tapi belum dibaca, update status
            $pesan->receivers()->updateExistingPivot($user->id, [
                'is_read' => true,
                'updated_at' => now(),
            ]);
        }

        return view('user.pesan.pesan-detail', compact('pesan'));
    }

    /**
     * Tandai semua pesan sebagai dibaca
     */
    public function markAllAsRead()
    {
        $user = auth()->user();
        $team = $user->team;
        
        if (!$team) {
            return redirect()->back()->with('error', 'Anda belum terdaftar dalam tim.');
        }

        // Ambil semua pesan untuk team
        $pesans = Pesan::forTeam($team->id)->get();

        foreach ($pesans as $pesan) {
            $existingPivot = $pesan->receivers()->where('user_id', $user->id)->first();
            
            if (!$existingPivot) {
                // Jika belum ada di pivot, attach dengan status dibaca
                $pesan->receivers()->attach($user->id, [
                    'is_read' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } elseif (!$existingPivot->pivot->is_read) {
                // Jika ada tapi belum dibaca, update
                $pesan->receivers()->updateExistingPivot($user->id, [
                    'is_read' => true,
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Semua pesan telah ditandai sebagai dibaca.');
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