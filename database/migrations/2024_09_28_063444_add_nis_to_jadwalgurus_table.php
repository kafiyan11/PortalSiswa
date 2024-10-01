<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNisToJadwalgurusTable extends Migration
{
    public function up()
    {
        Schema::table('jadwalgurus', function (Blueprint $table) {
            $table->string('nis')->after('id'); // Menambahkan kolom NIS
        });
    }

    public function down()
    {
        Schema::table('jadwalgurus', function (Blueprint $table) {
            $table->dropColumn('nis'); // Menghapus kolom NIS jika migrasi dibatalkan
        });
    }
}

