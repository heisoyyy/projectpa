<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasils', function (Blueprint $table) {
            $table->decimal('nilai_baris', 5, 2)->change();
            $table->decimal('nilai_variasi', 5, 2)->change();
            $table->decimal('nilai_formasi', 5, 2)->change();
            $table->decimal('nilai_kompak', 5, 2)->change();
            $table->decimal('total', 5, 2)->change();
        });
    }

    public function down(): void
    {
        Schema::table('hasils', function (Blueprint $table) {
            $table->unsignedTinyInteger('nilai_baris')->change();
            $table->unsignedTinyInteger('nilai_variasi')->change();
            $table->unsignedTinyInteger('nilai_formasi')->change();
            $table->unsignedTinyInteger('nilai_kompak')->change();
            $table->float('total', 8, 2)->change();
        });
    }
};
