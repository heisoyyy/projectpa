<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    // Halaman History Notifikasi
    public function index()
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.notifikasi.index', compact('notifikasi'));
    }

    // Tandai sebagai sudah dibaca
    public function markAsRead($id)
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())->findOrFail($id);
        $notifikasi->update(['is_read' => true]);

        return back()->with('success', 'Notifikasi ditandai sebagai dibaca.');
    }

    // Hapus notifikasi
    public function destroy($id)
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())->findOrFail($id);
        $notifikasi->delete();

        return back()->with('success', 'Notifikasi berhasil dihapus.');
    }
}
