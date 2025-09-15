<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama_tim', 'status'];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function jadwal()
    {
        return $this->hasOne(\App\Models\Jadwal::class);
    }
    public function sekolah()
    {
        return $this->belongsTo(User::class, 'user_id'); // atau table sekolah jika ada
    }
    // App\Models\Team.php
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function pesans()
    {
        return $this->hasMany(Pesan::class, 'tujuan');
    }
}
