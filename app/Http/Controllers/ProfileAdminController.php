<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileAdminController extends Controller
{
    public function edit()
    {
        $admin = Auth::user();
        return view('admin.profile-admin', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'nomor_sekolah' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data
        $admin->nama_sekolah = $request->nama_sekolah;
        $admin->nomor_sekolah = $request->nomor_sekolah;
        $admin->email = $request->email;

        // Upload foto profil jika ada
        if ($request->hasFile('foto_profile')) {
            if ($admin->foto_profile && Storage::exists('public/' . $admin->foto_profile)) {
                Storage::delete('public/' . $admin->foto_profile);
            }

            $path = $request->file('foto_profile')->store('profile', 'public');
            $admin->foto_profile = $path;
        }

        $admin->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
