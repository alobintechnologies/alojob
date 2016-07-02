<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAttachmentsWithLabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table ( 'attachments', function ($table) {
          // This will act as the file name for user. they can set any name for the file
          // which will be saved in here.
          $table->string('label')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table ( 'attachments', function ($table) {
          $table->dropColumn('label');
        });
    }
}
