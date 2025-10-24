<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\JadwalReminderMail;

class KirimReminderJadwal extends Command
{
    protected $signature = 'jadwal:kirim-reminder';
    protected $description = 'Kirim email reminder sebelum jadwal tampil peserta';

    public function handle()
    {
        $now = Carbon::now();
        $this->info("⏰ Sekarang: " . $now->format('Y-m-d H:i:s'));

        // Ambil semua jadwal beserta relasi user
        $jadwals = Jadwal::with('team.user')->get();

        foreach ($jadwals as $jadwal) {
            $jadwalTime = Carbon::parse($jadwal->tanggal . ' ' . $jadwal->waktu);

            // Reminder 10 menit sebelum tampil
            $reminder10 = $jadwalTime->copy()->subMinutes(10);
            if ($now->between($reminder10, $reminder10->copy()->addMinute())) {
                $this->kirimEmail($jadwal, '10 menit');
            }

            // Reminder 1 menit sebelum tampil
            $reminder1 = $jadwalTime->copy()->subMinute();
            if ($now->between($reminder1, $reminder1->copy()->addMinute())) {
                $this->kirimEmail($jadwal, '1 menit');
            }
        }
    }

    private function kirimEmail($jadwal, $jenis)
    {
        $email = $jadwal->team->user->email ?? null;

        if ($email) {
            Mail::to($email)->send(new JadwalReminderMail($jadwal, $jenis));

            $this->info("✅ Reminder {$jenis} terkirim ke {$email} (Jadwal: {$jadwal->waktu})");
        }
    }
}
