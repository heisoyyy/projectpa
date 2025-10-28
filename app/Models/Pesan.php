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

    // Scope untuk filter pesan berdasarkan user
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

    /**
     * Helper: Cek apakah pesan sudah dibaca oleh user tertentu
     */
    public function isReadBy($user)
    {
        $pivot = $this->receivers()->where('user_id', $user->id)->first();
        return $pivot ? $pivot->pivot->is_read : false;
    }

    /**
     * Helper: Tandai pesan sebagai dibaca untuk user tertentu
     */
    public function markAsReadBy($user)
    {
        $existingPivot = $this->receivers()->where('user_id', $user->id)->first();

        if (!$existingPivot) {
            // Jika belum ada, attach user dengan status dibaca
            $this->receivers()->attach($user->id, [
                'is_read' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } elseif (!$existingPivot->pivot->is_read) {
            // Jika sudah ada tapi belum dibaca, update status
            $this->receivers()->updateExistingPivot($user->id, [
                'is_read' => true,
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Helper: Tandai pesan sebagai belum dibaca untuk user tertentu
     */
    public function markAsUnreadBy($user)
    {
        $this->receivers()->updateExistingPivot($user->id, [
            'is_read' => false,
            'updated_at' => now(),
        ]);
    }

    /**
     * Helper: Hitung jumlah user yang sudah membaca pesan
     */
    public function readersCount()
    {
        return $this->receivers()->wherePivot('is_read', true)->count();
    }

    /**
     * Helper: Hitung jumlah user yang belum membaca pesan
     */
    public function unreadersCount()
    {
        return $this->receivers()->wherePivot('is_read', false)->count();
    }
}