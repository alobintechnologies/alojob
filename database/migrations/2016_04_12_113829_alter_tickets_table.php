<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tickets', function(Blueprint $table) {
        $table->integer('ticket_category_id')->unsigned();
				$table->integer('ticket_status')->default(0);

				$table->foreign('ticket_category_id')->references('id')->on('ticket_categories');
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
			$table->dropForeign('tickets_ticket_category_id_foreign');
			$table->dropColumn('ticket_category_id');
			$table->dropColumn('ticket_status');
		});
	}

}
