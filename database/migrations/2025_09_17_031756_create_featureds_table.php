<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('featureds', function (Blueprint $table) {
            $table->id();
            $table->string('judul');        // contoh: "Lomba Ketangkasan Baris Berbaris"
            $table->string('sub_judul');    // contoh: "KOMANDO"
            $table->string('gambar')->nullable();      // path gambar featured
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('featureds');
    }
};
