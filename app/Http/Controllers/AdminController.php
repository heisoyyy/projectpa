<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Daftar sekolah (semua tim)
    public function index()
    {
        $teams = Team::withCount(['pelatih', 'peserta'])->get();
        return view('admin.daftar-admin', compact('teams'));
    }

    // Detail sekolah per tim
    public function detail($id)
    {
        $team = Team::with(['members', 'user'])->findOrFail($id);
        return view('admin.detail-sekolah', compact('team'));
    }

    // Update status verifikasi
    public function verifikasi(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,verified',
        ]);

        $team->status = $request->status;
        $team->save();

        // 🔥 Catat aktivitas terbaru
        Activity::create([
            'team_id' => $team->id,
            'action' => 'Perubahan status verifikasi tim',
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status tim berhasil diperbarui.');
    }
    public function updateTim(Request $request, $id)
    {
        $team = Team::with(['members', 'user'])->findOrFail($id);

        // Update nama tim & kota
        $team->update([
            'nama_tim' => $request->nama_tim,
        ]);

        $team->user->update([
            'kota' => $request->kota,
        ]);

        // Update PESERTA
        if ($request->has('peserta')) {
            foreach ($request->peserta as $pid => $data) {
                $peserta = $team->members->where('id', $pid)->first();

                if ($peserta) {
                    $peserta->nama = $data['nama'];
                    $peserta->posisi = $data['posisi'];
                    $peserta->nis = $data['nis'];

                    if (isset($data['dokumen_1'])) {
                        $peserta->dokumen_1 = $data['dokumen_1']->store('dokumen', 'public');
                    }

                    if (isset($data['dokumen_2'])) {
                        $peserta->dokumen_2 = $data['dokumen_2']->store('dokumen', 'public');
                    }

                    $peserta->save();
                }
            }
        }

        // Update PELATIH
        if ($request->has('pelatih')) {
            foreach ($request->pelatih as $pid => $data) {
                $pelatih = $team->members->where('id', $pid)->first();

                if ($pelatih) {
                    $pelatih->nama = $data['nama'];
                    $pelatih->nomor_hp = $data['nomor_hp'];
                    $pelatih->save();
                }
            }
        }

        return back()->with('success', 'Data tim dan anggota berhasil diperbarui.');
    }
    public function manageUser()
    {
        $users = User::whereIn('role', ['admin', 'juri'])->get();
        return view('admin.manage-user', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'nama' => 'required',
            'role' => 'required|in:admin,juri',
            'password' => 'required|min:6'
        ]);

        User::create([
            'email' => $request->email,
            'nama_sekolah' => $request->nama,
            'nomor_sekolah' => '-',
            'kota' => '-',
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'is_verified' => 1,
            'status' => 'active',
        ]);

        return back()->with('success', 'User berhasil ditambahkan!');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'nama' => 'required',
            'role' => 'required|in:admin,juri'
        ]);

        $user->email = $request->email;
        $user->nama_sekolah = $request->nama;
        $user->role = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'User berhasil diperbarui!');
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User berhasil dihapus!');
    }
}
