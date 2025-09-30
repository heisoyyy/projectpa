<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingUserController extends Controller
{
    // 📝 Tampilkan halaman setting
    public function index()
    {
        return view('user.setting-user');
    }

    // 🔑 Proses update password
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

        // Cegah password baru sama dengan lama
        if (Hash::check($request->password_baru, $user->password)) {
            return back()->withErrors(['password_baru' => 'Password baru tidak boleh sama dengan password lama.']);
        }

        // Update password
        $user->password = Hash::make($request->password_baru);
        $user->save();

        // Logout setelah update
        Auth::logout();

        return redirect()->route('login.form')->with('success', 'Password berhasil diperbarui. Silakan login kembali.');
    }
}
