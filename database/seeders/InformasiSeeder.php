<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Informasi\Informasi;
use App\Models\Informasi\Biodata;
use App\Models\Informasi\Dokumen;
use App\Models\Informasi\History;

class InformasiSeeder extends Seeder
{
    public function run(): void
    {
        // Hero Section
        Informasi::create([
            'title' => 'Informasi LKBB Komando 2025',
            'description' => 'Seputar sejarah, dokumentasi, dan panduan lomba',
            'background' => 'assets/images/background.jpg'
        ]);

        // Biodata
        Biodata::insert([
            [
                'nama' => 'Bapak Ahmad Hidayat',
                'deskripsi' => 'Kepala Sekolah SMAN Plus Provinsi Riau',
                'foto' => 'assets/images/kepsek.jpg'
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'deskripsi' => 'Ketua OSIS SMAN Plus Provinsi Riau',
                'foto' => 'assets/images/ketuaosis.jpg'
            ]
        ]);

        // Dokumen
        Dokumen::insert([
            [
                'judul' => 'Guide Book',
                'thumbnail' => 'assets/images/Dokumen.png',
                'file' => 'dokumen/guidebook.pdf'
            ],
            [
                'judul' => 'Surat Pernyataan',
                'thumbnail' => 'assets/images/Dokumen.png',
                'file' => 'dokumen/surat_pernyataan.pdf'
            ],
            [
                'judul' => 'Poster',
                'thumbnail' => 'assets/images/Dokumen.png',
                'file' => 'dokumen/poster.pdf'
            ],
            [
                'judul' => 'Surat Undangan',
                'thumbnail' => 'assets/images/Dokumen.png',
                'file' => 'dokumen/poster.pdf'
            ],
            [
                'judul' => 'Tata Tertib',
                'thumbnail' => 'assets/images/Dokumen.png',
                'file' => 'dokumen/poster.pdf'
            ],
            [
                'judul' => 'Pengumuman',
                'thumbnail' => 'assets/images/Dokumen.png',
                'file' => 'dokumen/poster.pdf'
            ],
        ]);

        // History
        History::insert([
            [
                'nama_sekolah' => 'SMAN 1 Pekanbaru',
                'kota' => 'Pekanbaru',
                'deskripsi' => 'Juara 1 LKBB Komando 2024 dengan variasi baris-berbaris inovatif.',
                'image' => 'assets/images/Sekolah.png'
            ],
            [
                'nama_sekolah' => 'SMAN 2 Kampar',
                'kota' => 'Kampar',
                'deskripsi' => 'Finalis yang menonjol dengan variasi formasi klasik.',
                'image' => 'assets/images/Sekolah.png'
            ],
            [
                'nama_sekolah' => 'SMAN 2 Pelalawan',
                'kota' => 'Pelalawan',
                'deskripsi' => 'Peserta dengan formasi kreatif memukau penonton.',
                'image' => 'assets/images/Sekolah.png'
            ],
            [
                'nama_sekolah' => 'SMAN 1 Pekanbaru',
                'kota' => 'Pekanbaru',
                'deskripsi' => 'Juara 1 LKBB Komando 2024 dengan variasi baris-berbaris inovatif.',
                'image' => 'assets/images/Sekolah.png'
            ],
            [
                'nama_sekolah' => 'SMAN 2 Kampar',
                'kota' => 'Kampar',
                'deskripsi' => 'Finalis yang menonjol dengan variasi formasi klasik.',
                'image' => 'assets/images/Sekolah.png'
            ],
            [
                'nama_sekolah' => 'SMAN 2 Pelalawan',
                'kota' => 'Pelalawan',
                'deskripsi' => 'Peserta dengan formasi kreatif memukau penonton.',
                'image' => 'assets/images/Sekolah.png'
            ],
            [
                'nama_sekolah' => 'SMAN 1 Pekanbaru',
                'kota' => 'Pekanbaru',
                'deskripsi' => 'Juara 1 LKBB Komando 2024 dengan variasi baris-berbaris inovatif.',
                'image' => 'assets/images/Sekolah.png'
            ],
            [
                'nama_sekolah' => 'SMAN 2 Kampar',
                'kota' => 'Kampar',
                'deskripsi' => 'Finalis yang menonjol dengan variasi formasi klasik.',
                'image' => 'assets/images/Sekolah.png'
            ],
            [
                'nama_sekolah' => 'SMAN 2 Pelalawan',
                'kota' => 'Pelalawan',
                'deskripsi' => 'Peserta dengan formasi kreatif memukau penonton.',
                'image' => 'assets/images/Sekolah.png'
            ],
        ]);
    }
}
