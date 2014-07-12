<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('VenueTableSeeder');
	}

}

class VenueTableSeeder extends Seeder {

    public function run()
    {
        //DB::table('venues')->delete();
    		$cafeJsonOriginal = file_get_contents("app/database/seeds/data/cafe.json");
    		var_dump($cafeJsonOriginal);
    		$cafeJson = json_decode($cafeJsonOriginal, true);
    		var_dump($cafeJson);
        //Venue::create(array('email' => 'foo@bar.com'));
    }

}