<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reminder30MenitMail;

class KirimReminder30Menit extends Command
{
    protected $signature = 'jadwal:reminder-30';
    protected $description = 'Kirim email 30 menit sebelum jadwal tampil';

    public function handle()
    {
        $now = Carbon::now('Asia/Jakarta');
        $this->info("Sekarang: " . $now);

        $jadwals = Jadwal::with('team.user')
            ->where('reminder_sent', false)
            ->get();

        $this->info("Total jadwal ditemukan: " . $jadwals->count());

        foreach ($jadwals as $jadwal) {

            $jadwalTime = Carbon::parse(
                $jadwal->tanggal . ' ' . $jadwal->waktu,
                'Asia/Jakarta'
            );

            $reminderTime = $jadwalTime->copy()->subMinutes(30);

            $this->info("Jadwal tampil: " . $jadwalTime);
            $this->info("Waktu reminder: " . $reminderTime);

            if ($now->greaterThanOrEqualTo($reminderTime) && !$jadwal->reminder_sent) {

                $email = $jadwal->team->user->email ?? null;

                if ($email) {
                    Mail::to($email)->send(new Reminder30MenitMail($jadwal));

                    $jadwal->update([
                        'reminder_sent' => true
                    ]);

                    $this->info("✅ Email terkirim ke {$email}");
                }
            }
        }
    }
}
