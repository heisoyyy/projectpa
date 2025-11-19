<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Informasi\Informasi;

class AuthController extends Controller
{
    // 🟢 REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'nama_sekolah' => 'required|string|max:255',
            'nomor_sekolah' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
        ]);

        $otp = rand(100000, 999999);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nama_sekolah' => $request->nama_sekolah,
            'nomor_sekolah' => $request->nomor_sekolah,
            'kota' => $request->kota,
            'role' => 'user',
            'otp_code' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpMail($otp));

        return redirect()->route('verify.form', ['email' => $user->email])
            ->with('success', 'Registrasi berhasil! Silakan cek email untuk kode verifikasi.');
    }

    // 🟢 LOGIN
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Admin
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect('/admin')->with('success', 'Selamat datang Admin!');
            }

            // User belum diverifikasi
            if (!$user->is_verified) {
                Auth::logout();
                return back()->with('error', 'Email belum diverifikasi. Silakan cek email Anda.');
            }
            // Juri
            if ($user->role === 'juri') {
                $request->session()->regenerate();
                return redirect('/juri')->with('success', 'Selamat datang Juri!');
            }

            // User terverifikasi
            $request->session()->regenerate();
            return redirect('/user')->with('success', 'Login berhasil, selamat datang!');
        }

        return back()->with('error', 'Login gagal! Email atau password salah.');
    }

    // 🟢 LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/home/login')->with('success', 'Berhasil logout.');
    }

    // 🟢 TAMPILKAN FORM PENDAFTARAN
    public function showForm()
    {
        $informasi = Informasi::first();
        return view('home.pendaftaran', compact('informasi'));
    }

    // 🟢 FORM VERIFIKASI OTP
    public function showVerifyForm(Request $request)
    {
        $email = $request->query('email');
        $user = User::where('email', $email)->first();

        // ✅ Jika user tidak ditemukan
        if (!$user) {
            return redirect()->route('login.form')->with('error', 'Email tidak ditemukan.');
        }

        // ✅ Jika sudah diverifikasi manual oleh admin
        if ($user->is_verified) {
            return redirect()->route('login.form')->with('success', 'Akun Anda sudah diverifikasi. Silakan login.');
        }

        // ✅ Jika belum diverifikasi, tampilkan form OTP
        return view('home.verify', compact('email'));
    }

    // 🟢 PROSES VERIFIKASI OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        // ✅ Jika sudah diverifikasi (baik lewat OTP atau manual admin)
        if ($user->is_verified) {
            return redirect()->route('login.form')->with('success', 'Akun Anda sudah diverifikasi. Silakan login.');
        }

        // ✅ Jika OTP salah / kadaluarsa
        if (
            $user->otp_code !== $request->otp_code ||
            $user->otp_expires_at < now()
        ) {
            return back()->with('error', 'Kode OTP salah atau sudah kedaluwarsa.');
        }

        // ✅ Update user jadi verified
        $user->update([
            'is_verified' => 1,
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        return redirect()->route('login.form')->with('success', 'Verifikasi berhasil! Silakan login.');
    }

    // 🟢 KIRIM ULANG OTP
    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        // Jika sudah diverifikasi, hentikan
        if ($user->is_verified) {
            return back()->with('error', 'Akun sudah terverifikasi. Silakan login.');
        }

        $otp = rand(100000, 999999);

        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        try {
            Mail::to($user->email)->send(new OtpMail($otp));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim ulang OTP. Silakan coba lagi.');
        }

        return redirect()->route('verify.form', ['email' => $user->email])
            ->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}
