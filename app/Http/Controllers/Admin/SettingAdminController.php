<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SettingAdminController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        return view('admin.setting-admin', compact('admin'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        $admin = Auth::user();

        if (!Hash::check($request->password_lama, $admin->password)) {
            return back()->with('error', 'Password lama salah.');
        }

        $admin->password = Hash::make($request->password_baru);
        $admin->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
