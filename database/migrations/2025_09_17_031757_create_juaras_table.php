<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('juaras', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->integer('juara');
            $table->string('nama_sekolah');
            $table->string('pelatih');
            $table->integer('jumlah_tim');
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('juaras');
    }
};
