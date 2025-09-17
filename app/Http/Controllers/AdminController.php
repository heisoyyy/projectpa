<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Activity;
use Illuminate\Http\Request;

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
        $team = Team::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,verified',
        ]);

        $team->status = $request->status;
        $team->save();

        // 🔥 Catat aktivitas terbaru
        Activity::create([
            'team_id' => $team->id,
            'action' => 'Perubahan status verifikasi tim',
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status tim berhasil diperbarui.');
    }
}
