<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity');
            $now = Carbon::now();

            if ($lastActivity && $now->diffInHours(Carbon::parse($lastActivity)) >= 24) {
                Auth::logout();
                session()->flush();
                return redirect()->route('login.form')
                    ->with('error', 'Sesi Anda telah berakhir, silakan login kembali.');
            }

            session(['last_activity' => $now]);
        }

        return $next($request);
    }
}
