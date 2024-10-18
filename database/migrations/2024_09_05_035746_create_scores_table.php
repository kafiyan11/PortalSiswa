
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeScoreColumnsNullable extends Migration
{
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->float('daily_test_score')->nullable()->change();
            $table->float('midterm_test_score')->nullable()->change();
            $table->float('final_test_score')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->float('daily_test_score')->nullable(false)->change();
            $table->float('midterm_test_score')->nullable(false)->change();
            $table->float('final_test_score')->nullable(false)->change();
        });
    }
}

