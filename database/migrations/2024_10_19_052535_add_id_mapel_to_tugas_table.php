<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mapel')->nullable(); // Menambahkan kolom id_mapel
        });
    }
    
    public function down()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropColumn('id_mapel'); // Menghapus kolom id_mapel
        });
    }
    
};
