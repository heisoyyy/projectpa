<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id','role','nama','posisi','nis','nomor_hp','dokumen_1','dokumen_2'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
