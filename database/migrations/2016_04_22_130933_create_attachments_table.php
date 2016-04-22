<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * This table is used to store the attachments or files
         */
        Schema::create ( 'attachments', function ($table) {
          $table->increments ( 'id' );
          $table->string ( 'attachment_url', 1000 );
          $table->string ( 'attachable_type' )->index ();
          $table->integer ( 'attachable_id' )->unsigned ();

          $table->integer ( 'account_id' )->unsigned ()->index ();
          $table->integer ( 'project_id' )->unsigned ()->nullable()->index();
          $table->integer ( 'user_id' )->unsigned ()->index ();

          $table->timestamps ();

          $table->foreign ( 'account_id' )->references ( 'id' )->on ( 'accounts' )->onDelete ( 'cascade' );
          $table->foreign ( 'project_id' )->references ( 'id' )->on ( 'projects' )->onDelete ( 'cascade' );
          $table->foreign ( 'user_id' )->references ( 'id' )->on ( 'users' )->onDelete ( 'cascade' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists ( 'attachments' );
    }
}
