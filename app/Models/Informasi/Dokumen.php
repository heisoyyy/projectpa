<?php

namespace App\Models\Informasi;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = ['judul', 'thumbnail', 'file'];
}
