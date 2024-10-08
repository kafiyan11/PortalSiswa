<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriTable extends Migration
{
    /**
     * Buat tabel materi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('tipe'); // Kolom untuk menyimpan tipe materi ('gambar' atau 'link_youtube')
            $table->string('gambar')->nullable(); // Menyimpan path gambar
            $table->string('link_youtube')->nullable(); // Menyimpan link YouTube
            $table->timestamps();
        });
        
        // Cek apakah tabel materi sudah ada sebelum membuatnya
        if (!Schema::hasTable('materi')) {
            Schema::create('materi', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('judul');
                $table->string('tipe');
                $table->string('gambar')->nullable();
                $table->string('link_youtube')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Hapus tabel materi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materi');
    }
}
