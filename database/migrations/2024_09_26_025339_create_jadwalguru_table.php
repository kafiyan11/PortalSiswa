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
        Schema::create('jadwalguru', function (Blueprint $table) {
                $table->id();
                $table->string('kelas');
                $table->string('guru');
                $table->time('jam_mulai');
                $table->time('jam_selesai');
                $table->timestamps();
                $table->string('ganjil_genap');
                $table->string('hari');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwalguru');
    }
};
