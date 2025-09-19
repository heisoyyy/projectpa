<?php

namespace App\Models\Informasi;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['nama_sekolah', 'kota', 'image', 'deskripsi'];
}
