<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('social_links', function (Blueprint $table) {
            $table->string('alamat')->nullable();      // Address
            $table->string('telepon')->nullable();     // Phone
            $table->string('email')->unique();         // Email
            $table->string('jam_buka')->nullable();    // Opening Hours
        });
    }

    public function down()
    {
        Schema::table('social_links', function (Blueprint $table) {
            $table->dropColumn(['alamat', 'telepon', 'email', 'jam_buka']);
        });
    }
};
