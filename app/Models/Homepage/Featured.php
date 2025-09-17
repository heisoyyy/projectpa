<?php

namespace App\Models\Homepage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'sub_judul',
        'gambar',
    ];

    // Relasi ke Accordion
    public function accordions()
    {
        return $this->hasMany(Accordion::class);
    }
}
