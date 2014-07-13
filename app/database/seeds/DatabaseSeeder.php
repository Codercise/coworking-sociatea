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
  		$jsonOriginal = file_get_contents("app/database/data/venues.json");
  		//var_dump($cafeJsonOriginal);
  		$json = json_decode($jsonOriginal, true);
  		//var_dump($json);
      //Venue::create(array('email' => 'foo@bar.com'));
      /*for ($i=0; $i < count($json); $i++) {
        echo $json[$i]["AP NAME"];
        $venue = new Venue;
        WifiPoint::create(array(
          'name' => $json[$i]["AP NAME"],
          'latitude' => $json[$i]["latitude"],
          'longitude' => $json[$i]["longitude"]
        ));
      }*/
      for ($i = 0; $i < count($json); $i++) {
          echo $json[$i]["id"];
          WifiVenue::create(array(
            'wifi_point_id' => $json[$i]["id"],
            'pubs' => implode('; ', $json[$i]["pubs"]),
            'cafes' => implode('; ', $json[$i]["cafes"]),
            'restaurants' => implode('; ', $json[$i]["restaurants"]),
            'libraries' => implode('; ', $json[$i]["libraries"])
          ));
      }
    }

}