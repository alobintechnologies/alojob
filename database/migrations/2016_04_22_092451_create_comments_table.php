<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * This table is used to store the comments or discussions
         */
        Schema::create('comments', function($table) {
            $table->increments('id');
            $table->text('comment')->nullable();
            $table->integer('parent_id')->default(-1);
            $table->string('commentable_type')->index();
            $table->bigInteger('commentable_id')->unsigned();

            $table->integer('account_id')->unsigned()->index();
            $table->integer('author_id')->unsigned()->index();

            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
