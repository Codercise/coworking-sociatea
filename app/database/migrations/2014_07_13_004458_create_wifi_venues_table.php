<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWifiVenuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wifi_venues', function($t) {
			$t->increments('id');
			$t->string('wifi_point_id');
			$t->string('pubs');
			$t->string('cafes');
			$t->string('restaurants');
			$t->string('libraries');
			$t->timestamps();
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
