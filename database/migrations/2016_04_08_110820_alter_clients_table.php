<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clients', function(Blueprint $table) {
				$table->softDeletes();
				$table->integer('user_id')->unsigned();
				$table->integer('account_id')->unsigned();

				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('account_id')->references('id')->on('accounts');
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clients');
	}

}
