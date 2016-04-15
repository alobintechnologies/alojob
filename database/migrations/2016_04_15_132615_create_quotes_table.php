<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quotes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('Quote #new');
						$table->string('notes')->nullable();
						$table->decimal('amount', 15, 2);
						$table->integer('quote_status_id');
						$table->integer('user_id')->unsigned();
						$table->integer('project_id')->unsigned()->nullable();
						$table->integer('account_id')->unsigned();

						$table->foreign('user_id')->references('id')->on('users');
						$table->foreign('account_id')->references('id')->on('accounts');
						$table->foreign('project_id')->references('id')->on('projects');

						$table->softDeletes();
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quotes');
	}

}
