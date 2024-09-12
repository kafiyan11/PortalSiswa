<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_jadwals_table.php

public function up()
{
    Schema::create('jadwals', function (Blueprint $table) {
        $table->id();
        $table->string('kelas');
        $table->string('mata_pelajaran');
        $table->string('guru');
        $table->time('jam_mulai');
        $table->time('jam_selesai');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
