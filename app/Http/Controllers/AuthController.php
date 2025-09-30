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

        // Generate OTP 6 digit
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

        // Kirim OTP ke email
        Mail::to($user->email)->send(new OtpMail($otp));

        return redirect()->route('verify.form', ['email' => $user->email])
            ->with('success', 'Registrasi berhasil! Silakan cek email untuk kode verifikasi.');
    }

    // LOGIN
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // 🟢 Admin tidak perlu verifikasi OTP
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect('/admin')->with('success', 'Selamat datang Admin!');
            }

            // 🟡 User biasa harus verifikasi OTP
            if (!$user->is_verified) {
                Auth::logout();
                return back()->with('error', 'Email belum diverifikasi. Silakan cek email Anda.');
            }

            // 🟢 Login user biasa
            $request->session()->regenerate();
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
    public function showVerifyForm(Request $request)
    {
        $email = $request->query('email');
        return view('home.verify', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)
            ->where('otp_code', $request->otp_code)
            ->where('otp_expires_at', '>=', now())
            ->first();

        if (!$user) {
            return back()->with('error', 'Kode OTP salah atau sudah kadaluarsa.');
        }

        $user->update([
            'is_verified' => 1,
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        return redirect()->route('login.form')->with('success', 'Verifikasi berhasil! Silakan login.');
    }
}
