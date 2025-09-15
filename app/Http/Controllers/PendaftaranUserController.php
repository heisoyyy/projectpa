<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;

class PendaftaranUserController extends Controller
{
    // Tampilkan form pendaftaran
    public function index()
    {
        $team = Auth::user()->team ?? null;
        return view('user.pendaftaran-user', compact('team'));
    }

    // Simpan pendaftaran baru
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->team) {
            return redirect()->back()->with('error', 'Anda sudah mendaftar tim.');
        }

        $team = Team::create([
            'user_id' => $user->id,
            'nama_tim' => $user->nama_sekolah,
            'status' => 'pending'
        ]);

        // PESERTA
        $pesertas = $request->input('peserta', []);
        foreach ($pesertas as $i => $p) {
            Member::create([
                'team_id' => $team->id,
                'role' => 'peserta',
                'nama' => $p['nama'],
                'nis' => $p['nis'],
                'posisi' => $p['posisi'],
                'dokumen_1' => $request->file("peserta.$i.dokumen_1")?->store('pendaftaran', 'public'),
                'dokumen_2' => $request->file("peserta.$i.dokumen_2")?->store('pendaftaran', 'public'),
            ]);
        }

        // PELATIH
        $pelatihs = $request->input('pelatih', []);
        foreach ($pelatihs as $i => $p) {
            Member::create([
                'team_id' => $team->id,
                'role' => 'pelatih',
                'nama' => $p['nama'],
                'nomor_hp' => $p['nomor_hp'],
            ]);
        }

        return redirect()->route('user.pendaftaran.index')->with('success', 'Pendaftaran berhasil.');
    }

    // Update pendaftaran (via modal Ubah)
    public function update(Request $request, Team $team)
    {
        // 1. Update anggota lama
        foreach ($team->members as $member) {
            $roleKey = $member->role;

            $updateData = [
                'nama' => $request->input("{$roleKey}.{$member->id}.nama"),
                'nis' => $request->input("{$roleKey}.{$member->id}.nis"),
            ];

            if ($roleKey == 'peserta') {
                $updateData['posisi'] = $request->input("{$roleKey}.{$member->id}.posisi");

                if ($request->hasFile("{$roleKey}.{$member->id}.dokumen_1")) {
                    $updateData['dokumen_1'] = $request->file("{$roleKey}.{$member->id}.dokumen_1")
                        ->store('pendaftaran', 'public');
                }

                if ($request->hasFile("{$roleKey}.{$member->id}.dokumen_2")) {
                    $updateData['dokumen_2'] = $request->file("{$roleKey}.{$member->id}.dokumen_2")
                        ->store('pendaftaran', 'public');
                }
            } elseif ($roleKey == 'pelatih') {
                $updateData['nomor_hp'] = $request->input("{$roleKey}.{$member->id}.nomor_hp");
            }

            $member->update($updateData);
        }

        // 2. Tambah peserta baru
        $newPesertas = $request->input('peserta', []);
        foreach ($newPesertas as $key => $p) {
            if (str_starts_with($key, 'new_')) {
                Member::create([
                    'team_id' => $team->id,
                    'role' => 'peserta',
                    'nama' => $p['nama'],
                    'nis' => $p['nis'] ?? null,
                    'posisi' => $p['posisi'] ?? null,
                    'dokumen_1' => $request->file("peserta.$key.dokumen_1")?->store('pendaftaran', 'public'),
                    'dokumen_2' => $request->file("peserta.$key.dokumen_2")?->store('pendaftaran', 'public'),
                ]);
            }
        }

        // 3. Tambah pelatih baru
        $newPelatihs = $request->input('pelatih', []);
        foreach ($newPelatihs as $key => $p) {
            if (str_starts_with($key, 'new_')) {
                Member::create([
                    'team_id' => $team->id,
                    'role' => 'pelatih',
                    'nama' => $p['nama'],
                    'nomor_hp' => $p['nomor_hp'] ?? null,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data tim berhasil diperbarui.');
    }
}
