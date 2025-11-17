<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Hasil;
use App\Models\Jadwal;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HasilExport;

class LaporanController extends Controller
{
    // Halaman laporan admin
    public function index()
    {
        $totalSekolah = Team::count();
        $totalJadwal  = Jadwal::count();
        $totalDinilai = Hasil::distinct('team_id')->count('team_id');

        $juaraSatu = Hasil::with('team.users')->get()
            ->groupBy('team_id')
            ->map(function ($items) {
                $avgTotal = $items->avg('total');
                $team = $items->first()->team;
                return (object)[
                    'team_id' => $team->id,
                    'total_nilai' => $avgTotal,
                    'nama_tim' => $team->nama_tim ?? '-',
                    'anggota' => $team->users->pluck('name')->toArray()
                ];
            })
            ->sortByDesc('total_nilai')
            ->first();

        $hasil = Hasil::with('team.users')->get()
            ->groupBy('team_id')
            ->map(function ($items, $team_id) {
                $avgTotal = $items->avg('total');
                $team = $items->first()->team;
                return (object)[
                    'team_id' => $team_id,
                    'total_nilai' => $avgTotal,
                    'nama_tim' => $team->nama_tim ?? '-',
                    'anggota' => $team->users->pluck('name')->toArray()
                ];
            })
            ->sortByDesc('total_nilai')
            ->values()
            ->map(function ($item, $index) {
                $item->ranking = $index + 1;
                return $item;
            });

        return view('admin.laporan-admin', compact(
            'totalSekolah',
            'totalJadwal',
            'totalDinilai',
            'juaraSatu',
            'hasil'
        ));
    }

    // Detail tim
    public function detail($team_id)
    {
        $team = Team::with('users')->findOrFail($team_id);
        $hasil = Hasil::where('team_id', $team_id)->get();
        $total_nilai = $hasil->avg('total');

        $ranking = Hasil::select('team_id', DB::raw('AVG(total) as avg_total'))
            ->groupBy('team_id')
            ->orderByDesc('avg_total')
            ->get()
            ->values()
            ->search(fn($item) => $item->team_id == $team_id) + 1;

        return view('admin.hasil-detail', compact('team', 'hasil', 'total_nilai', 'ranking'));
    }

    // Export PDF
    public function exportPdf()
    {
        $hasil = Hasil::with('team.users')->get()
            ->groupBy('team_id')
            ->map(function ($items, $team_id) {
                $avgTotal = $items->avg('total');
                $team = $items->first()->team;
                return (object)[
                    'team_id' => $team_id,
                    'total_nilai' => $avgTotal,
                    'nama_tim' => $team->nama_tim ?? '-',
                    'anggota' => $team->users->pluck('name')->toArray()
                ];
            })
            ->sortByDesc('total_nilai')
            ->values()
            ->map(function ($item, $index) {
                $item->ranking = $index + 1;
                return $item;
            });

        $pdf = PDF::loadView('admin.exports.hasil-pdf', compact('hasil'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-hasil.pdf');
    }

    // Export Excel
    public function exportExcel()
    {
        return Excel::download(new HasilExport, 'laporan-hasil.xlsx');
    }

    // Backup database
    public function backup()
    {
        $dbName = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST', '127.0.0.1');

        $fileName = "backup-" . date('Y-m-d-H-i-s') . ".sql";
        $storagePath = storage_path("app/$fileName");

        $command = "mysqldump -h {$host} -u {$username} --password=\"{$password}\" {$dbName} > \"{$storagePath}\"";
        system($command, $result);

        if ($result !== 0) {
            return back()->with('error', 'Gagal melakukan backup database.');
        }

        return response()->download($storagePath)->deleteFileAfterSend(true);
    }

    // Reset database
    public function reset()
    {
        Hasil::truncate();
        Jadwal::truncate();
        Team::truncate();

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Database berhasil direset!');
    }
}
