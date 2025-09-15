<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->enum('role', ['peserta', 'pelatih']);
            $table->string('nama');
            $table->string('posisi')->nullable(); // untuk peserta: danton/anggota/cadangan
            $table->string('nis')->nullable();
            $table->string('nomor_hp')->nullable(); // untuk pelatih
            $table->string('dokumen_1')->nullable(); // kartu pelajar/pas photo
            $table->string('dokumen_2')->nullable(); // pas photo/kartu pelajar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
