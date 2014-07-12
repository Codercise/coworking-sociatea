<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Checkins extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('checkins', function($t) {
			$t->increments('id');
			$t->integer('venue_id', false)->unsigned();
			$t->integer('user_id', false)->unsigned();
			$t->timestamps();
			$t->foreign('venue_id')->references('id')->on('venues');
			$t->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
