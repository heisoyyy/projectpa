<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use App\Models\Pesan;
use App\Models\Team;
use App\Models\Notifikasi;

class DashboardUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        \Log::info('✅ MASUK DashboardUserController@index', ['user_id' => $userId]);

        $team = $user->team;
        $notifikasi = Notifikasi::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        $jadwal = $sebelum = $sesudah = null;
        $alerts = [];

        // Fungsi pembantu buat session key unik per user
        $key = fn($base) => "{$base}_alert_shown_user_{$userId}";

        // Jika user belum punya tim
        if (!$team) {
            if (!session()->has($key('belum_tim'))) {
                $alerts[] = [
                    'type' => 'belum_tim',
                    'message' => 'Lengkapi data tim dan dokumen peserta terlebih dahulu sebelum melanjutkan.',
                    'priority' => 5
                ];
                session()->put($key('belum_tim'), true);
            }
        } else {
            // 🟡 Cek kelengkapan dokumen
            $pesertaCount = $team->members->where('role', 'peserta')->count();
            $dok1 = $team->members->where('role', 'peserta')->whereNotNull('dokumen_1')->count();
            $dok2 = $team->members->where('role', 'peserta')->whereNotNull('dokumen_2')->count();
            $surat = $user->foto_surat_izin ? true : false;
            $isComplete = $pesertaCount > 0 && $dok1 > 0 && $dok2 > 0 && $surat;

            if ($isComplete && !session()->has($key('dokumen_lengkap'))) {
                $alerts[] = [
                    'type' => 'dokumen_lengkap',
                    'priority' => 4
                ];
                session()->put($key('dokumen_lengkap'), true);
            } elseif (!$isComplete && !session()->has($key('dokumen_belum_lengkap'))) {
                $alerts[] = [
                    'type' => 'dokumen_belum_lengkap',
                    'priority' => 4
                ];
                session()->put($key('dokumen_belum_lengkap'), true);
            }

            // 🟢 Cek status verifikasi
            if ($team->status === 'verified' && !session()->has($key('verified'))) {
                $alerts[] = [
                    'type' => 'verified',
                    'priority' => 3
                ];
                session()->put($key('verified'), true);

                $this->buatNotifikasiUnik(
                    $userId,
                    'Status Tim Terverifikasi',
                    'Tim Anda telah diverifikasi oleh panitia. Selamat!'
                );
            }

            // 📅 Cek jadwal tampil
            $jadwal = Jadwal::where('team_id', $team->id)->first();
            if ($jadwal && !session()->has($key('jadwal'))) {
                $alerts[] = [
                    'type' => 'jadwal',
                    'priority' => 2
                ];
                session()->put($key('jadwal'), true);

                $this->buatNotifikasiUnik(
                    $userId,
                    'Jadwal Tampil Sudah Tersedia',
                    'Tim Anda telah mendapatkan jadwal tampil dari panitia.'
                );
            }

            // 🔹 Ambil jadwal sebelum dan sesudah tim ini
            if ($jadwal) {
                $sebelum = Jadwal::where('tanggal', $jadwal->tanggal)
                    ->where('urutan', '<', $jadwal->urutan)
                    ->orderBy('urutan', 'desc')
                    ->first();

                $sesudah = Jadwal::where('tanggal', $jadwal->tanggal)
                    ->where('urutan', '>', $jadwal->urutan)
                    ->orderBy('urutan', 'asc')
                    ->first();
            }
        }

        // Urutkan alert berdasar prioritas
        usort($alerts, fn($a, $b) => $a['priority'] <=> $b['priority']);

        // Kirim ke session untuk view
        if (!empty($alerts)) {
            session()->flash('dashboard_alerts', $alerts);
            \Log::info('🚨 ALERT DITEMUKAN', ['alerts' => $alerts]);
        }

        // Ambil pengumuman
        $pengumuman = Pesan::where(function ($q) use ($team) {
            $q->where('tujuan', 'all');
            if ($team) {
                $q->orWhereRaw("FIND_IN_SET(?, tujuan)", [$team->id]);
            }
        })->latest()->take(5)->get();

        return view('user.home-user', compact(
            'user',
            'team',
            'jadwal',
            'sebelum',
            'sesudah',
            'pengumuman',
            'notifikasi'
        ));
    }

    private function buatNotifikasiUnik($userId, $judul, $pesan)
    {
        if (!Notifikasi::where('user_id', $userId)->where('judul', $judul)->exists()) {
            Notifikasi::create([
                'user_id' => $userId,
                'judul' => $judul,
                'pesan' => $pesan,
                'is_read' => false,
            ]);
        }
    }
}
