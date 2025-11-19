<?php

namespace App\Http\Controllers\juri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class SettingJuriController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $juri */
        $juri = Auth::user();

        return view('juri.setting-juri', compact('juri'));
    }

    public function updatePassword(Request $request)
    {
        // 🔒 Validasi input form
        $request->validate([
            'password_lama' => 'required|string',
            'password_baru' => 'required|string|min:8|confirmed',
        ], [
            'password_lama.required' => 'Password lama wajib diisi.',
            'password_baru.required' => 'Password baru wajib diisi.',
            'password_baru.min' => 'Password baru minimal 8 karakter.',
            'password_baru.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // ✅ Pastikan variabel bertipe App\Models\User agar Intelephense tahu method `save()` valid
        /** @var \App\Models\User $juri */
        $juri = Auth::user();

        // 🔐 Cek apakah password lama benar
        if (!Hash::check($request->password_lama, $juri->password)) {
            return back()->with('error', 'Password lama yang Anda masukkan salah.');
        }

        // ✅ Update password baru dan simpan ke database
        $juri->password = Hash::make($request->password_baru);
        $juri->save(); // <--- Tidak akan error lagi di VS Code

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}
