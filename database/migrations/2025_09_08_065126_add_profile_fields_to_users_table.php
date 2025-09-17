<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'nomor_sekolah')) {
                $table->string('nomor_sekolah')->nullable()->after('nama_sekolah');
            }
            if (!Schema::hasColumn('users', 'kota')) {
                $table->string('kota')->nullable()->after('nomor_sekolah');
            }
            if (!Schema::hasColumn('users', 'foto_profile')) {
                $table->string('foto_profile')->nullable()->after('kota');
            }
            if (!Schema::hasColumn('users', 'foto_surat_izin')) {
                $table->string('foto_surat_izin')->nullable()->after('foto_profile');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'nomor_sekolah')) {
                $table->dropColumn('nomor_sekolah');
            }
            if (Schema::hasColumn('users', 'kota')) {
                $table->dropColumn('kota');
            }
            if (Schema::hasColumn('users', 'foto_profile')) {
                $table->dropColumn('foto_profile');
            }
            if (Schema::hasColumn('users', 'foto_surat_izin')) {
                $table->dropColumn('foto_surat_izin');
            }
        });
    }
};
