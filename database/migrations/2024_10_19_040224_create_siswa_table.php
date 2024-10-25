<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id(); // ID siswa
            $table->string('nama'); // Nama siswa
            $table->string('nis')->unique(); // Nomor Induk Siswa
            $table->unsignedBigInteger('user_id')->nullable(); // Relasi ke pengguna (jika ada)
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswa');
    }
};
