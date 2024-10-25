<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('id'); // Adjust the position as needed
            
            // Optionally, add a foreign key constraint
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropForeign(['parent_id']); // Drop foreign key
            $table->dropColumn('parent_id'); // Drop the column
        });
    }
    
};
