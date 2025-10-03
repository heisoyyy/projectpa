<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Homepage\Banner;
use App\Models\Homepage\Featured;
use App\Models\Homepage\Accordion;
use App\Models\Homepage\Video;
use App\Models\Homepage\Statistik;
use App\Models\Homepage\Juara;

class HomepageSeeder extends Seeder
{
    public function run(): void
    {
        // Banner
        Banner::create([
            'judul' => 'SMAN PLUS PROVINSI RIAU',
            'sub_judul' => 'Haloo PLUSERR',
            'kategori' => 'LKBB KOMANDO 2025',
            'gambar' => 'banner1.jpg'
        ]);

        Banner::create([
            'judul' => 'SMAN 1 Pekanbaru',
            'sub_judul' => 'HALO SMANSA',
            'kategori' => 'LKBB 2024',
            'gambar' => 'banner2.jpg'
        ]);

        // Featured
        $featured = Featured::create([
            'judul' => 'Lomba Ketangkasan Baris Berbaris',
            'sub_judul' => 'KOMANDO',
            'gambar' => 'featured.jpg'
        ]);

        // Accordion (pastikan featured_id sesuai dengan Featured yang dibuat)
        Accordion::create([
            'featured_id' => $featured->id,
            'pertanyaan' => 'Apa itu LKBB Komando?',
            'jawaban' => 'Ajang tahunan yang diselenggarakan SMAN Plus Provinsi Riau untuk menguji ketangkasan baris berbaris.'
        ]);

        Accordion::create([
            'featured_id' => $featured->id,
            'pertanyaan' => 'Siapa saja yang bisa ikut?',
            'jawaban' => 'Peserta berasal dari SMA/SMK se-Indonesia.'
        ]);
        Accordion::create([
            'featured_id' => $featured->id,
            'pertanyaan' => 'Siapa saja yang bisa ikut?',
            'jawaban' => 'Peserta berasal dari SMA/SMK se-Indonesia.'
        ]);

        // Video
        Video::create([
            'judul' => 'LKBB Komando Recap',
            'link' => 'https://youtube.com/watch?v=abcd1234',
            'thumbnail' => 'video1.jpg',
            'background' => 'video1.jpg'
        ]);

        // Statistik
        Statistik::create([
            'judul_section' => 'LKBB Komando 2025',
            'label' => 'Pendaftar',
            'jumlah' => 20
        ]);

        Statistik::create([
            'judul_section' => 'LKBB Komando 2025',
            'label' => 'Diterima',
            'jumlah' => 11
        ]);

        Statistik::create([
            'judul_section' => 'LKBB Komando 2025',
            'label' => 'Diproses',
            'jumlah' => 9
        ]);

        // Juara
        Juara::create([
            'tahun' => 2024,
            'juara' => 1,
            'nama_sekolah' => 'SMAN 1 Pekanbaru',
            'pelatih' => 'Bapak Egy Maulana',
            'jumlah_tim' => 26,
            'gambar' => 'juara1.jpg',
            'deskripsi' => 'Juara 1 LKBB Komando 2024 dengan performa terbaik.'
        ]);

        Juara::create([
            'tahun' => 2024,
            'juara' => 2,
            'nama_sekolah' => 'SMAN 2 Pekanbaru',
            'pelatih' => 'Bapak Rizky Ridho',
            'jumlah_tim' => 24,
            'gambar' => 'juara2.jpg',
            'deskripsi' => 'Juara 2 LKBB Komando 2024 dengan strategi solid.'
        ]);
    }
}
