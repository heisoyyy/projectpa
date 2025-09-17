<?php

namespace App\Models\Homepage;

use Illuminate\Database\Eloquent\Model;

class Juara extends Model
{
    protected $fillable = ['tahun', 'juara', 'nama_sekolah', 'pelatih', 'jumlah_tim', 'gambar', 'deskripsi'];
}
