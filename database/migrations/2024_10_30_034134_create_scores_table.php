<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->float('daily_test_score')->nullable();
            $table->float('midterm_test_score')->nullable();
            $table->float('final_test_score')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scores');
    }
};
