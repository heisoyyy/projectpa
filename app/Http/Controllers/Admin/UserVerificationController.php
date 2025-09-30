<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->orderBy('created_at', 'desc')->get();
        return view('admin.verifikasi-admin', compact('users'));
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

        return back()->with('success', 'User berhasil diverifikasi secara manual.');
    }
}
