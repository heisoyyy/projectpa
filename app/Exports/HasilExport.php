<?php

namespace App\Exports;

use App\Models\Hasil;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HasilExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Hasil::with('team.users')->get()
            ->groupBy('team_id')
            ->map(function ($items, $team_id) {
                $avgTotal = $items->avg('total');
                $team = $items->first()->team;
                return [
                    'No'          => 0,
                    'Sekolah'     => $team->user->nama_sekolah ?? '-',
                    'Total Nilai' => $avgTotal,
                    'Ranking'     => 0,
                    'Anggota'     => implode(', ', $team->users->pluck('name')->toArray())
                ];
            })
            ->sortByDesc('Total Nilai')
            ->values()
            ->map(function ($item, $index) {
                $item['No'] = $index + 1;
                $item['Ranking'] = $index + 1;
                return $item;
            });
    }

    public function headings(): array
    {
        return ['No', 'Sekolah', 'Total Nilai', 'Ranking', 'Anggota'];
    }
}
