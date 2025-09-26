<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Informasi\Informasi;

class ContactController extends Controller
{
    public function contact()
    {
        $informasi = Informasi::first(); // ambil data pertama untuk background
        return view('home.contact', compact('informasi'));
    }

    public function send(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'pesan' => 'required|string|max:1000',
        ], [
            'name.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'subject.required' => 'Subject wajib diisi',
            'pesan.required' => 'Pesan wajib diisi',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Data untuk email
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->pesan,
                'sent_at' => now()->format('d/m/Y H:i:s')
            ];

            // Kirim email ke Gmail pribadi (soyuuyuzzy@gmail.com)
            Mail::to(env('CONTACT_EMAIL', 'soyuuyuzzy@gmail.com'))
                ->send(new ContactMail($data));

            return back()->with('success', 'Pesan berhasil dikirim! Terima kasih atas laporannya.');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal mengirim pesan: ' . $e->getMessage())
                ->withInput();
        }
    }
}