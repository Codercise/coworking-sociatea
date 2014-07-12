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
    		$cafeJsonOriginal = file_get_contents("app/database/data/libraries.json");
    		//var_dump($cafeJsonOriginal);
    		$cafeJson = json_decode($cafeJsonOriginal, true);
    		var_dump($cafeJson);
        //Venue::create(array('email' => 'foo@bar.com'));
        for ($i=0; $i < count($cafeJson); $i++) {
          echo $cafeJson[$i]["NAME"];
          $venue = new Venue;
          Venue::create(array(
            'name' => $cafeJson[$i]["NAME"],
            'address' => $cafeJson[$i]["ADDRESS"],
            'latitude' => $cafeJson[$i]["XCoord"],
            'longitude' => $cafeJson[$i]["YCoord"],
            'type' => 'Libraries'
          ));
        }
    }

}