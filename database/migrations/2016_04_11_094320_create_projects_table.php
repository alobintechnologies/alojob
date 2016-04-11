<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table) {
        $table->increments('id');
        $table->string('title')->default('Project #1');
        $table->string('description', 255)->nullable();
				$table->integer('user_id')->unsigned();
				$table->integer('account_id')->unsigned();

				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('account_id')->references('id')->on('accounts');
        $table->timestamps();
				$table->softDeletes();
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
	}

}
