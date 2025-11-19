<?php

namespace App\Http\Controllers\juri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PesertaJuriController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('role', 'user')->orderBy('created_at', 'desc')->get();
        return view('juri.peserta-sekolah', compact('users'));
    }
}
