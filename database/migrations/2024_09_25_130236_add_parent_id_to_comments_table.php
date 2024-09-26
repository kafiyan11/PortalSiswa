<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('post_id'); // Menambahkan kolom parent_id
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade'); // Menambahkan foreign key
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['parent_id']); // Menghapus foreign key
            $table->dropColumn('parent_id');    // Menghapus kolom parent_id
        });
    }
}

