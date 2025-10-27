<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('role', 'user')->orderBy('created_at', 'desc')->get();

        // 🔥 Ambil user yang daftar hari ini
        $todayRegistrations = User::whereDate('created_at', today())
            ->where('role', 'user')
            ->get();

        // ✅ Tampilkan notifikasi hanya SEKALI per session
        $showNotification = false;
        if (!$request->session()->has('shown_today_notification') && $todayRegistrations->count() > 0) {
            $showNotification = true;
            $request->session()->put('shown_today_notification', true);
        }

        return view('admin.verifikasi-admin', compact('users', 'todayRegistrations', 'showNotification'));
    }

    public function verifyUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->is_verified) {
            return back()->with('info', 'User ini sudah terverifikasi.');
        }

        $user->update([
            'is_verified' => 1,
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        return redirect()->route('admin.verifikasi.index')
            ->with('success', 'User berhasil diverifikasi secara manual.');
    }
    public function destroy($id)
    {
        $user = \App\Models\User::findOrFail($id);

        try {
            // jika user punya team atau relasi lain, hapus dulu relasinya
            if ($user->team) {
                $user->team->delete();
            }

            $user->delete();

            return redirect()->back()->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}
