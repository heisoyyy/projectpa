<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Notifications\TeamStatusUpdated;


class AdminController extends Controller
{
    // Daftar sekolah (semua tim)
    public function index()
    {
        $teams = Team::withCount('members')->get();
        return view('admin.daftar-admin', compact('teams'));
    }

    // Detail sekolah per tim
    public function detail($id)
    {
        $team = Team::with(['members', 'user'])->findOrFail($id);
        return view('admin.detail-sekolah', compact('team'));
    }

    // Update status verifikasi
    public function verifikasi(Request $request, $id)
    {
        $team = Team::with('user')->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,verified,revisi',
        ]);

        $team->status = $request->status;
        $team->save();

        // kirim notifikasi ke user pemilik tim
        $team->user->notify(new TeamStatusUpdated($team));

        return redirect()->route('admin.daftar')
            ->with('success', 'Status tim berhasil diperbarui dan peserta diberitahu.');
    }
}
