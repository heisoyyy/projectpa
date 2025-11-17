<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PendaftaranUserController extends Controller
{
    /**
     * Tampilkan halaman pendaftaran dengan semua tim user
     */
    public function index()
    {
        // Ambil semua tim milik user yang login beserta members-nya
        $teams = Auth::user()->teams()->with('members')->get();
        
        return view('user.pendaftaran-user', compact('teams'));
    }

    /**
     * Simpan tim baru
     */
    public function storeTeam(Request $request)
    {
        $request->validate([
            'nama_tim' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        // Cek apakah nama tim sudah ada untuk user ini
        $exists = $user->teams()->where('nama_tim', $request->nama_tim)->exists();
        
        if ($exists) {
            return redirect()->back()->with('error', 'Nama tim sudah ada! Gunakan nama yang berbeda.');
        }

        // Buat tim baru
        Team::create([
            'user_id' => $user->id,
            'nama_tim' => $request->nama_tim,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Tim "' . $request->nama_tim . '" berhasil ditambahkan!');
    }

    /**
     * Simpan anggota tim (peserta & pelatih)
     */
    public function storeMembers(Request $request, $teamId)
    {
        // Validasi bahwa tim ini milik user yang login
        $team = Team::where('id', $teamId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Cek apakah tim sudah diverifikasi
        if ($team->status === 'verified') {
            return response()->json([
                'success' => false,
                'message' => 'Tim sudah diverifikasi, tidak bisa diubah!'
            ], 403);
        }

        DB::beginTransaction();
        try {
            // ========== TAMBAH PESERTA BARU ==========
            $pesertas = $request->input('peserta', []);
            foreach ($pesertas as $key => $p) {
                if (!empty($p['nama'])) {
                    // Jika key dimulai dengan 'new_', ini adalah data baru
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
                    } else {
                        // Ini adalah update member yang sudah ada
                        $member = Member::where('id', $key)
                            ->where('team_id', $team->id)
                            ->first();
                        
                        if ($member) {
                            $updateData = [
                                'nama' => $p['nama'],
                                'nis' => $p['nis'] ?? null,
                                'posisi' => $p['posisi'] ?? null,
                            ];

                            // Upload dokumen baru jika ada
                            if ($request->hasFile("peserta.$key.dokumen_1")) {
                                if ($member->dokumen_1) {
                                    Storage::disk('public')->delete($member->dokumen_1);
                                }
                                $updateData['dokumen_1'] = $request->file("peserta.$key.dokumen_1")
                                    ->store('pendaftaran', 'public');
                            }

                            if ($request->hasFile("peserta.$key.dokumen_2")) {
                                if ($member->dokumen_2) {
                                    Storage::disk('public')->delete($member->dokumen_2);
                                }
                                $updateData['dokumen_2'] = $request->file("peserta.$key.dokumen_2")
                                    ->store('pendaftaran', 'public');
                            }

                            $member->update($updateData);
                        }
                    }
                }
            }

            // ========== TAMBAH PELATIH BARU ==========
            $pelatihs = $request->input('pelatih', []);
            foreach ($pelatihs as $key => $p) {
                if (!empty($p['nama'])) {
                    // Jika key dimulai dengan 'new_', ini adalah data baru
                    if (str_starts_with($key, 'new_')) {
                        Member::create([
                            'team_id' => $team->id,
                            'role' => 'pelatih',
                            'nama' => $p['nama'],
                            'nomor_hp' => $p['nomor_hp'] ?? null,
                        ]);
                    } else {
                        // Ini adalah update member yang sudah ada
                        $member = Member::where('id', $key)
                            ->where('team_id', $team->id)
                            ->first();
                        
                        if ($member) {
                            $member->update([
                                'nama' => $p['nama'],
                                'nomor_hp' => $p['nomor_hp'] ?? null,
                            ]);
                        }
                    }
                }
            }

            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Data anggota berhasil disimpan!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update anggota tim
     */
    public function updateMembers(Request $request, $teamId)
    {
        return $this->storeMembers($request, $teamId);
    }

    /**
     * Hapus tim beserta semua anggotanya
     */
    public function deleteTeam($teamId)
    {
        // Validasi tim milik user yang login
        $team = Team::where('id', $teamId)
            ->where('user_id', Auth::id())
            ->with('members')
            ->firstOrFail();

        // Cek apakah tim sudah diverifikasi
        if ($team->status === 'verified') {
            return response()->json([
                'success' => false,
                'message' => 'Tim sudah diverifikasi, tidak bisa dihapus!'
            ], 403);
        }

        DB::beginTransaction();
        try {
            // Hapus file dokumen dari storage
            foreach ($team->members as $member) {
                if ($member->dokumen_1) {
                    Storage::disk('public')->delete($member->dokumen_1);
                }
                if ($member->dokumen_2) {
                    Storage::disk('public')->delete($member->dokumen_2);
                }
            }

            // Hapus semua member
            $team->members()->delete();

            // Hapus tim
            $team->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Tim berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus tim: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Hapus member (peserta/pelatih)
     */
    public function deleteMember($memberId)
    {
        // Validasi member milik tim yang dimiliki user login
        $member = Member::whereHas('team', function($query) {
            $query->where('user_id', Auth::id())
                  ->where('status', '!=', 'verified');
        })->findOrFail($memberId);

        DB::beginTransaction();
        try {
            // Hapus file dokumen jika ada
            if ($member->dokumen_1) {
                Storage::disk('public')->delete($member->dokumen_1);
            }
            if ($member->dokumen_2) {
                Storage::disk('public')->delete($member->dokumen_2);
            }

            // Hapus member
            $member->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Anggota berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus anggota: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * BACKWARD COMPATIBILITY - untuk route lama
     * Method store() yang lama untuk mendukung sistem lama
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Cek apakah user sudah punya tim
        if ($user->teams()->exists()) {
            return redirect()->back()->with('error', 'Anda sudah mendaftar tim.');
        }

        // Buat tim baru dengan nama sekolah
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

    /**
     * BACKWARD COMPATIBILITY - untuk route lama
     * Method update() yang lama
     */
    public function update(Request $request, Team $team)
    {
        // Validasi kepemilikan
        if ($team->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return $this->storeMembers($request, $team->id);
    }
}