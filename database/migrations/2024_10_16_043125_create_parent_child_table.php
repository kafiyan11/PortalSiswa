<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('parent_child', function (Blueprint $table) {
            $table->id(); // Optional: add an ID for the pivot table
            $table->foreignId('parent_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('child_id')->constrained('users')->onDelete('cascade');
            $table->timestamps(); // Optional: to keep track of the timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('parent_child');
    }
};
