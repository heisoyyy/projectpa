<?php

namespace App\Http\Controllers;

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
        // Ambil semua data dari database
        $banners     = Banner::all();
        $featured    = Featured::first();
        $accordions  = Accordion::all();
        $videos      = Video::all();

        $statistik   = Statistik::first();
        $statistikJudul = $statistik ? $statistik->judul_section : 'LKBB Komando 2025';
        $statistiks  = Statistik::all();

        $juaras      = Juara::all();

        // Kirim ke view home.index
        return view('home.index', compact(
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
