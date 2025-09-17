<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingUserController extends Controller
{
    public function updatePassword(Request $request)
    {
        
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'nomor_sekolah' => 'required|string',
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|confirmed',
        ]);

        // Cek nomor sekolah
        if ($request->nomor_sekolah !== $user->nomor_sekolah) {
            return back()->withErrors(['nomor_sekolah' => 'Nomor sekolah tidak cocok.']);
        }

        // Cek password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama salah.']);
        }

        // Update password baru
        $user->password = Hash::make($request->password_baru);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
