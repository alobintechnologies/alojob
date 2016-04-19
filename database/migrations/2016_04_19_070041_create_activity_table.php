<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /**
  		 * This table is used to store the activities happening in the project.
  		 * activity_meta, will consists of datas about activity.
  		 */
  		Schema::create ( 'activities', function (Blueprint $table) {
    			$table->increments ( 'id' );
    			$table->integer ( 'action_id' ); // created, updated, deleted
    			$table->timestamps ();

    			$table->integer ( 'account_id' )->unsigned ();
    			$table->integer ( 'user_id' )->unsigned ();
    			$table->integer ( 'project_id' )->unsigned ()->nullable();
    			$table->integer ( 'client_id' )->unsigned ()->nullable();
    			$table->string ( 'activatable_type' ); // Resource, Project,
    			$table->integer ( 'activatable_id' )->unsigned ();

    			$table->foreign ( 'account_id' )->references ( 'id' )->on ( 'accounts' )->onDelete ( 'cascade' );
    			$table->foreign ( 'user_id' )->references ( 'id' )->on ( 'users' )->onDelete ( 'cascade' );
    			$table->foreign ( 'client_id' )->references ( 'id' )->on ( 'clients' )->onDelete ( 'cascade' );
    			$table->foreign ( 'project_id' )->references ( 'id' )->on ( 'projects' )->onDelete ( 'cascade' );
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists( 'activities' );
    }
}
