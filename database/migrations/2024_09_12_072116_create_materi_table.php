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
        Schema::create('materi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('tipe'); // Kolom untuk menyimpan tipe materi ('gambar' atau 'link_youtube')
            $table->string('gambar')->nullable(); // Menyimpan path gambar
            $table->string('link_youtube')->nullable(); // Menyimpan link YouTube
            $table->timestamps();
        });;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
