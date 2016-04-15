<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProjectsWithClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('projects', function(Blueprint $table) {
        $table->integer('client_id')->unsigned();
        $table->foreign('client_id')->references('id')->on('clients');
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
  			$table->dropForeign('projects_client_id_foreign');
  			$table->dropColumn('client_id');
  		});
    }
}
