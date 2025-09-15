<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/home/login')->with('error', 'Silakan login dulu.');
        }

        if (Auth::user()->role !== $role) {
            return redirect('/home/login')->with('error', 'Akses ditolak!');
        }

        return $next($request);
    }
}
