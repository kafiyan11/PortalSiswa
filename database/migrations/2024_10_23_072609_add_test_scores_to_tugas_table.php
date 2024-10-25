<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('tugas', function (Blueprint $table) {
        $table->float('daily_test_score')->nullable(); // or whatever your intended type is
        $table->float('midterm_test_score')->nullable();
        $table->float('final_test_score')->nullable();
    });
}

public function down()
{
    Schema::table('tugas', function (Blueprint $table) {
        $table->dropColumn(['daily_test_score', 'midterm_test_score', 'final_test_score']);
    });
}

    
};
