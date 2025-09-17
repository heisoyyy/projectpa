<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileUserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $team = $user->team; // ambil tim user (nullable)
        $teamStatus = $team->status ?? null; // ambil status tim jika ada

        return view('user.profile-user', compact('user', 'team', 'teamStatus'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'kota'             => 'nullable|string|max:255',
            'foto_surat_izin'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user->kota = $request->kota;

        if ($request->hasFile('foto_surat_izin')) {
            if ($user->foto_surat_izin) {
                Storage::disk('public')->delete($user->foto_surat_izin);
            }
            $user->foto_surat_izin = $request->file('foto_surat_izin')->store('surat_izin', 'public');
        }

        $user->save();

        return redirect()->route('user.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }

    public function uploadFoto(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'foto_profile' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($user->foto_profile) {
            Storage::disk('public')->delete($user->foto_profile);
        }

        $user->foto_profile = $request->file('foto_profile')->store('profile', 'public');
        $user->save();

        return back()->with('success', 'Foto profil berhasil diunggah.');
    }
}
