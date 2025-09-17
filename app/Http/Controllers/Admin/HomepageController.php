<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homepage\Banner;
use App\Models\Homepage\Featured;
use App\Models\Homepage\Accordion;
use App\Models\Homepage\Video;
use App\Models\Homepage\Statistik;
use App\Models\Homepage\Juara;

class HomepageController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $featured = Featured::first();
        $accordions = Accordion::all();
        $videos = Video::all();
        $statistikJudul = Statistik::first()->judul_section ?? 'LKBB Komando 2025';
        $statistiks = Statistik::all();
        $juaras = Juara::all();

        return view('admin.kelola-homepage', compact(
            'banners',
            'featured',
            'accordions',
            'videos',
            'statistikJudul',
            'statistiks',
            'juaras'
        ));
    }
}
