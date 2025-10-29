<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsLoggedIn
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/home/login')
                ->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman ini.');
        }

        // Jika sudah login, lanjutkan request
        return $next($request);
    }
}
