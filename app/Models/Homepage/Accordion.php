<?php

namespace App\Models\Homepage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accordion extends Model
{
    use HasFactory;

    protected $fillable = [
        'featured_id',
        'pertanyaan',
        'jawaban',
    ];

    public function featured()
    {
        return $this->belongsTo(Featured::class);
    }
}
