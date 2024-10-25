<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nis');
            $table->string('kelas');
            $table->string('nohp');
            $table->string('alamat');
            $table->string('photo')->nullable(); // Foto anak
            $table->foreignId('parent_id')->constrained('users')->onDelete('cascade'); // Menghubungkan dengan tabel users
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('children');
    }
};
