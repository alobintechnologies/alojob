<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProjectsWithStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('projects', function(Blueprint $table) {
        $table->integer('project_status_id');
        $table->decimal('amount', 15, 2);
        $table->decimal('balance', 15, 2);
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
        $table->dropColumn('project_status_id');
        $table->dropColumn('amount');
        $table->dropColumn('balance');
      });
    }
}
