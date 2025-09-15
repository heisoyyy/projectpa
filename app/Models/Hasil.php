<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'nilai_baris',
        'nilai_variasi',
        'nilai_formasi',
        'nilai_kompak',
        'total',   // pastikan ada
        'catatan',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
