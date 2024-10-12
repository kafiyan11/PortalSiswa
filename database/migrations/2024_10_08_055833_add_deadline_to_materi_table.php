<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('materi', function (Blueprint $table) {
            $table->dateTime('deadline')->nullable(); // Menambahkan kolom deadline
        });
    }
    
    public function down()
    {
        Schema::table('materi', function (Blueprint $table) {
            $table->dropColumn('deadline'); // Menghapus kolom deadline
        });
    }
    
};
