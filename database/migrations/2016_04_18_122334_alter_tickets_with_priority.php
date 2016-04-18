<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTicketsWithPriority extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('tickets', function(Blueprint $table) {
        $table->integer('priority_id')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('tickets', function(Blueprint $table) {
        $table->dropColumn('priority_id')->nullable();
      });
    }
}
