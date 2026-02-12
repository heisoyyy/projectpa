<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(\Illuminate\Console\Scheduling\Schedule $schedule): void
    {
        // Jalankan tiap menit
        $schedule->command('jadwal:kirim-reminder')->everyMinute();
        $schedule->command('jadwal:reminder-30')->everyMinute();
    }
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
}
