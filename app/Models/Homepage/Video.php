<?php

namespace App\Models\Homepage;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['judul', 'link', 'background', 'thumbnail'];
}
