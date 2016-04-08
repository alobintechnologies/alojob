<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 25);
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('company_name', 255);
            $table->string('primary_mobile', 15);
            $table->string('secondary_mobile', 15);
            $table->string('primary_email', 255);
            $table->string('secondary_email', 255);
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
		Schema::drop('clients');
	}

}
