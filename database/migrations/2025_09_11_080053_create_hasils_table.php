<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->unsignedTinyInteger('nilai_baris');   // nilai 0-100
            $table->unsignedTinyInteger('nilai_variasi');
            $table->unsignedTinyInteger('nilai_formasi');
            $table->unsignedTinyInteger('nilai_kompak');
            $table->float('total', 8, 2); // simpan 2 angka di belakang koma
            $table->text('catatan')->nullable();
            $table->boolean('is_published')->default(false); // <== tombol share nanti update ini
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasils');
    }
};
