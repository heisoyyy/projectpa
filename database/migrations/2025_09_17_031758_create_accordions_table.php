<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accordions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('featured_id')->nullable()->constrained('featureds')->onDelete('cascade');
            $table->string('pertanyaan');
            $table->text('jawaban');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accordions');
    }
};
