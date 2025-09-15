<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->string('tujuan'); // 'all' atau "1,2,3" (id team)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesans');
    }
};
