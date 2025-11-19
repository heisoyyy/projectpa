<?php

namespace App\Http\Controllers\juri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileJuriController extends Controller
{
    public function edit()
    {
        $juri = Auth::user();
        return view('juri.profile-juri', compact('juri'));
    }

    public function update(Request $request)
    {
        $juri = Auth::user();

        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'nomor_sekolah' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $juri->id,
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data
        $juri->nama_sekolah = $request->nama_sekolah;
        $juri->nomor_sekolah = $request->nomor_sekolah;
        $juri->email = $request->email;

        // Upload foto profil jika ada
        if ($request->hasFile('foto_profile')) {
            if ($juri->foto_profile && Storage::exists('public/' . $juri->foto_profile)) {
                Storage::delete('public/' . $juri->foto_profile);
            }

            $path = $request->file('foto_profile')->store('profile', 'public');
            $juri->foto_profile = $path;
        }

        $juri->save();

        return redirect()->route('juri.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
