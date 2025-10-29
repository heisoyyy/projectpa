<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function showResetForm(Request $request, $token = null)
    {
        Log::info('=== SHOW RESET FORM ===');
        Log::info('Token: ' . $token);
        Log::info('Email from request: ' . $request->email);

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    /**
     * Handle an incoming password reset request.
     */
    public function reset(Request $request)
    {
        Log::info('=== RESET PASSWORD ATTEMPT START ===');
        Log::info('Request Data:', [
            'email' => $request->email,
            'token' => $request->token,
            'has_password' => !empty($request->password),
            'has_confirmation' => !empty($request->password_confirmation),
            'password_match' => $request->password === $request->password_confirmation
        ]);

        // Cek token di database
        $tokenRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        Log::info('Token in database:', [
            'exists' => $tokenRecord ? 'Yes' : 'No',
            'token_preview' => $tokenRecord ? substr($tokenRecord->token, 0, 10) . '...' : 'N/A',
            'created_at' => $tokenRecord ? $tokenRecord->created_at : 'N/A'
        ]);

        // Validasi
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8|confirmed',
            ], [
                'email.exists' => 'Email tidak ditemukan di sistem kami.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            ]);

            Log::info('✅ Validation passed');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ Validation failed:', $e->errors());
            throw $e;
        }

        // Attempt to reset the user's password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                Log::info('🔄 Callback executed', [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                ]);

                $oldPasswordHash = $user->password;
                
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                $newPasswordHash = $user->fresh()->password;

                Log::info('✅ Password updated', [
                    'old_hash_preview' => substr($oldPasswordHash, 0, 20) . '...',
                    'new_hash_preview' => substr($newPasswordHash, 0, 20) . '...',
                    'hashes_different' => $oldPasswordHash !== $newPasswordHash
                ]);

                event(new PasswordReset($user));
            }
        );

        Log::info('Reset status: ' . $status);
        Log::info('Status comparison:', [
            'status' => $status,
            'PASSWORD_RESET' => Password::PASSWORD_RESET,
            'match' => $status === Password::PASSWORD_RESET,
            'INVALID_TOKEN' => Password::INVALID_TOKEN,
            'INVALID_USER' => Password::INVALID_USER,
        ]);

        // Check the status
        if ($status === Password::PASSWORD_RESET) {
            Log::info('✅✅✅ PASSWORD RESET SUCCESSFUL ✅✅✅');
            
            // Hapus token dari database
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->delete();
            
            Log::info('Token deleted from database');

            return redirect()->route('login.form')
                ->with('success', 'Password berhasil direset! Silakan login dengan password baru Anda.');
        }

        // If failed, return back with errors
        Log::error('❌❌❌ PASSWORD RESET FAILED ❌❌❌');
        Log::error('Failure reason: ' . $this->getErrorMessage($status));

        return back()->withErrors([
            'email' => $this->getErrorMessage($status)
        ])->withInput($request->only('email'));
    }

    /**
     * Get friendly error message.
     */
    private function getErrorMessage($status)
    {
        return match($status) {
            Password::INVALID_TOKEN => 'Token reset password tidak valid atau sudah kadaluarsa. Silakan minta link baru.',
            Password::INVALID_USER => 'Email tidak ditemukan di sistem kami.',
            Password::THROTTLED => 'Terlalu banyak percobaan. Silakan coba lagi nanti.',
            default => 'Terjadi kesalahan. Silakan coba lagi.',
        };
    }
}