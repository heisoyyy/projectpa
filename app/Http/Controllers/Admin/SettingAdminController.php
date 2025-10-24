<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // pastikan ini ditambahkan agar tipe model dikenali

class SettingAdminController extends Controller
{
    /**
     * Tampilkan halaman pengaturan admin
     */
    public function index()
    {
        /** @var \App\Models\User $admin */
        $admin = Auth::user();

        return view('admin.setting-admin', compact('admin'));
    }

    /**
     * Update password admin
     */
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
        /** @var \App\Models\User $admin */
        $admin = Auth::user();

        // 🔐 Cek apakah password lama benar
        if (!Hash::check($request->password_lama, $admin->password)) {
            return back()->with('error', 'Password lama yang Anda masukkan salah.');
        }

        // ✅ Update password baru dan simpan ke database
        $admin->password = Hash::make($request->password_baru);
        $admin->save(); // <--- Tidak akan error lagi di VS Code

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}
