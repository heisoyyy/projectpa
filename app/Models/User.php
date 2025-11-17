<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Models\Pesan;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable implements CanResetPasswordContract
{
    use HasFactory, Notifiable, CanResetPassword;

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

        // 🟢 Kolom verifikasi & OTP
        'is_verified',
        'otp_code',
        'otp_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
    ];

    protected $casts = [
        'otp_expires_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    // Untuk get semua tim
    public function teams()
    {
        return $this->hasMany(Team::class, 'user_id');
    }

    // Helper untuk backward compatibility
    public function team()
    {
        return $this->hasOne(Team::class, 'user_id')->latest();
    }

    // Relasi: user bisa menerima banyak pesan
    public function pesans()
    {
        return $this->belongsToMany(Pesan::class, 'pesan_user')
            ->withPivot('is_read')
            ->withTimestamps();
    }

    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class);
    }
}
