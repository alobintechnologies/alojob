<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('Ticket #new');
            $table->text('description')->nullable();
						$table->integer('assigned_user_id')->unsigned();
						$table->integer('user_id')->unsigned();
						$table->integer('client_id')->unsigned()->nullable();
						$table->integer('project_id')->unsigned()->nullable();
						$table->integer('account_id')->unsigned();

						$table->foreign('user_id')->references('id')->on('users');
						$table->foreign('account_id')->references('id')->on('accounts');
						$table->foreign('client_id')->references('id')->on('clients');
						$table->foreign('project_id')->references('id')->on('projects');
						$table->foreign('assigned_user_id')->references('id')->on('users');
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
		Schema::drop('tickets');
	}

}
