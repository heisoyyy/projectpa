<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Informasi\Informasi;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'nama_sekolah' => 'required|string|max:255',
            'nomor_sekolah' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nama_sekolah' => $request->nama_sekolah,
            'nomor_sekolah' => $request->nomor_sekolah,
            'kota' => $request->kota,
            'team_id'      => $request->team_id,
            'role' => 'user',
        ]);

        return redirect()->route('login.form')->with('success', 'Registrasi berhasil! Silakan login.');
    }


    // LOGIN
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect('/admin')->with('success', 'Selamat datang Admin!');
            }

            return redirect('/user')->with('success', 'Login berhasil, selamat datang!');
        }

        return back()->with('error', 'Login gagal! Email atau password salah.');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/home/login')->with('success', 'Berhasil logout.');
    }
    // Tampilkan form pendaftaran
    public function showForm()
    {
        $informasi = Informasi::first(); // 🔥 untuk ambil background dll
        return view('home.pendaftaran', compact('informasi'));
    }
}
