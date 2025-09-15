<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'isi', 'tujuan'];

    // Relasi: pesan dikirim ke banyak user
    public function receivers()
    {
        return $this->belongsToMany(User::class, 'pesan_user')
            ->withPivot('is_read')
            ->withTimestamps();
    }

    // Filter pesan untuk team tertentu
    public function scopeForTeam($query, $teamId)
    {
        return $query->where(function ($q) use ($teamId) {
            $q->where('tujuan', 'all')
                ->orWhereRaw("FIND_IN_SET(?, tujuan)", [$teamId]);
        });
    }

    // accessor untuk nama sekolah tujuan
    public function getNamaSekolahTujuanAttribute()
    {
        if ($this->tujuan === 'all') {
            return 'Semua Sekolah';
        }

        $teamIds = explode(',', $this->tujuan);

        $teams = \App\Models\Team::with('user')
            ->whereIn('id', $teamIds)
            ->get();

        return $teams->pluck('user.nama_sekolah')->implode(', ');
    }

    // App\Models\Pesan.php
    public function scopeForUser($query, $user)
    {
        return $query->where(function ($q) use ($user) {
            $q->where('tujuan', 'all')
                ->orWhereRaw("FIND_IN_SET(?, tujuan)", [$user->team->id ?? 0]);
        });
    }
    public function team()
    {
        return $this->belongsTo(Team::class, 'tujuan');
    }
}
