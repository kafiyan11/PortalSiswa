<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->integer('daily_test_score');
            $table->integer('midterm_test_score');
            $table->integer('final_test_score');
            $table->timestamps();
            
            // Tambahkan foreign key
           // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
