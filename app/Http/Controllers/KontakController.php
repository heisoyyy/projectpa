<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi\Informasi;

class KontakController extends Controller
{
    public function contact()
    {
        $informasi = Informasi::first(); // ambil data pertama untuk background
        return view('home.contact', compact('informasi'));
    }
}
