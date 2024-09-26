<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->string('ganjil_genap')->after('tanggal'); // Menambahkan kolom 'ganjil_genap'
        });
    }
    
    public function down()
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropColumn('ganjil_genap');
        });
    }
    
};
