<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLendingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lendings', function(Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->integer('friend_id')->unsigned();
            $table->foreign('friend_id')->references('id')->on('friends');
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
		Schema::drop('lendings');
	}

}
