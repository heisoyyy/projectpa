<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesan;


class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check() && Auth::user()->team) {
                $user = Auth::user();

                // Gunakan paginate biar bisa pakai links()
                $pesans = Pesan::forUser($user)
                    ->latest()
                    ->paginate(10);

                $view->with('pesans', $pesans);
            }
        });
    }
}
