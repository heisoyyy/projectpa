<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        Log::info('=== FORGOT PASSWORD REQUEST ===');
        Log::info('Email: ' . $request->email);

        $request->validate(['email' => 'required|email']);

        // Cek apakah email ada di database
        $userExists = DB::table('users')
            ->where('email', $request->email)
            ->exists();

        Log::info('User exists: ' . ($userExists ? 'Yes' : 'No'));

        $status = Password::sendResetLink($request->only('email'));

        Log::info('Send reset link status: ' . $status);

        if ($status === Password::RESET_LINK_SENT) {
            Log::info('✅ Reset link sent successfully');
            
            // Cek apakah token tersimpan
            $token = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->first();
            
            Log::info('Token saved in database:', [
                'exists' => $token ? 'Yes' : 'No',
                'created_at' => $token ? $token->created_at : 'N/A'
            ]);

            return back()->with('success', 'Link reset password telah dikirim ke email Anda.');
        }

        Log::error('❌ Failed to send reset link');
        
        return back()->withErrors(['email' => 'Email tidak terdaftar atau gagal mengirim link.']);
    }
}