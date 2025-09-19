<?php

namespace App\Http\Controllers\Informasi;

use App\Http\Controllers\Controller;
use App\Models\Informasi\Informasi;
use App\Models\Informasi\Biodata;
use App\Models\Informasi\Dokumen;
use App\Models\Informasi\History;

class InformasiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::first(); 
        $biodata   = Biodata::all();      
        $dokumen   = Dokumen::all();      

        // Ambil semua history sekaligus (tanpa paginate)
        $allHistory = History::all();

        // Ambil daftar kota unik
        $kotas = $allHistory->pluck('kota')->unique();

        return view('home.informasi', compact('informasi', 'biodata', 'dokumen', 'allHistory', 'kotas'));
    }
}
