<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Pesan;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'nama_sekolah',
        'nomor_sekolah',
        'kota',
        'role',
        'status',
        'foto_profile',
        'foto_surat_izin',
    ];

    // Relasi: 1 User bisa punya banyak Team
    public function team()
    {
        return $this->hasOne(Team::class, 'user_id');
    }
    // public function team()
    // {
    //     return $this->belongsTo(Team::class);
    // }

    // Relasi: user bisa menerima banyak pesan
    public function pesans()
    {
        return $this->belongsToMany(Pesan::class, 'pesan_user')
            ->withPivot('is_read')
            ->withTimestamps();
    }
    
    
}
