<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropColumn('nis'); // Hapus field nis
        });
    }
    
    public function down()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->string('nis')->nullable(); // Tambahkan kembali jika rollback
        });
    }
    
};
