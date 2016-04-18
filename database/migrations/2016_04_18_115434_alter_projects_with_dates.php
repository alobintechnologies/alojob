<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProjectsWithDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('projects', function(Blueprint $table) {
        $table->timestamp('start_date')->nullable();
        $table->timestamp('end_date')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('projects', function(Blueprint $table) {
        $table->dropColumn('start_date');
        $table->dropColumn('end_date');
      });
    }
}
