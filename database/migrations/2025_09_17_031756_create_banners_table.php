<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('judul');       // contoh: "SMAN PLUS PROVINSI RIAU"
            $table->string('sub_judul');       // contoh: "SMAN PLUS PROVINSI RIAU"
            $table->string('kategori');    // contoh: "LKBB KOMANDO 2025"
            $table->string('gambar')->nullable();     // path gambar (storage/public/banner/..)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
