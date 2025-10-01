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
        $team = $user->team;
        $notifikasi = Notifikasi::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $jadwal = $sebelum = $sesudah = null;
        $isComplete = false;

        if ($team) {
            // 📝 CEK STATUS DOKUMEN
            $pesertaCount = $team->members->where('role', 'peserta')->count();
            $dok1 = $team->members->where('role', 'peserta')->whereNotNull('dokumen_1')->count();
            $dok2 = $team->members->where('role', 'peserta')->whereNotNull('dokumen_2')->count();
            $surat = $user->foto_surat_izin ? true : false;
            $isComplete = $pesertaCount > 0 && $dok1 > 0 && $dok2 > 0 && $surat;

            if (!session()->has('dokumen_state') || session('dokumen_state') !== ($isComplete ? 'complete' : 'incomplete')) {
                session()->flash('dokumen_alert', $isComplete ? 'complete' : 'incomplete');
                session()->put('dokumen_state', $isComplete ? 'complete' : 'incomplete');
            }

            // 🟢 STATUS TIM TERVERIFIKASI
            if ($team->status === 'verified') {
                if (!session()->has('status_verified_shown')) {
                    session()->flash('status_verified', true);
                    session()->put('status_verified_shown', true);

                    $this->buatNotifikasiUnik(
                        $user->id,
                        'Status Tim Terverifikasi',
                        'Tim Anda telah diverifikasi oleh panitia. Selamat!'
                    );
                }
            } else {
                session()->forget('status_verified_shown');
            }

            // 📅 CEK JADWAL TAMPIL
            $jadwal = Jadwal::where('team_id', $team->id)->first();
            if ($jadwal) {
                $sebelum = Jadwal::where('tanggal', $jadwal->tanggal)
                    ->where('urutan', '<', $jadwal->urutan)
                    ->orderBy('urutan', 'desc')
                    ->first();

                $sesudah = Jadwal::where('tanggal', $jadwal->tanggal)
                    ->where('urutan', '>', $jadwal->urutan)
                    ->orderBy('urutan', 'asc')
                    ->first();

                if (!session()->has('jadwal_alert_shown')) {
                    session()->flash('jadwal_baru', true);
                    session()->put('jadwal_alert_shown', true);

                    $this->buatNotifikasiUnik(
                        $user->id,
                        'Jadwal Tampil Sudah Tersedia',
                        'Tim Anda telah mendapatkan jadwal tampil dari panitia.'
                    );
                }
            } else {
                session()->forget('jadwal_alert_shown');
            }
        }

        $pengumuman = Pesan::where(function ($q) use ($team) {
            $q->where('tujuan', 'all');
            if ($team) {
                $q->orWhereRaw("FIND_IN_SET(?, tujuan)", [$team->id]);
            }
        })
            ->latest()
            ->take(5)
            ->get();

        return view('user.home-user', compact(
            'user',
            'team',
            'jadwal',
            'sebelum',
            'sesudah',
            'pengumuman',
            'notifikasi',
            'isComplete'
        ));
    }

    private function buatNotifikasiUnik($userId, $judul, $pesan)
    {
        if (!Notifikasi::where('user_id', $userId)->where('judul', $judul)->exists()) {
            Notifikasi::create([
                'user_id' => $userId,
                'judul'   => $judul,
                'pesan'   => $pesan,
                'is_read' => false,
            ]);
        }
    }
}
