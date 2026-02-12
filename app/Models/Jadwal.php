<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'tanggal',
        'waktu',
        'tempat',
        'team_id',
        'urutan',
        'reminder_sent'
    ];

    protected $attributes = [
        'reminder_sent' => 0,
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

