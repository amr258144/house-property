<?php

use Illuminate\Database\Seeder;

class PropertyTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$districtId = DB::table('districts')->pluck('district_id')->toArray();
    	$compoundId = DB::table('compounds')->pluck('compound_id')->toArray();
    	$buidingId = DB::table('buildings')->pluck('building_id')->toArray();
    	$promotionId = DB::table('promotions')->pluck('promotion_id')->toArray();

        for($i = 0; $i < 100; $i++) {
        	$d = array_rand($districtId);
        	$c = array_rand($compoundId);
        	$b = array_rand($buidingId);
        	$p = array_rand($promotionId);
        	DB::table('property')->insert([
        		'name' => $this->generateRandomString(8),
        		'a_name' => array_rand(['عندما' => 0, 'يريد' => 1, 'فهو' => 2]),
        		'district_id' => $districtId[$d],
        		'compound_id' => $compoundId[$c],
        		'building_id' => $buidingId[$b],
        		'promotion_id' => $promotionId[$p],
        		'no_bathrooms' => rand(1,10),
        		'no_bedrooms' => rand(0,10),
        		'no_guest_rooms' => rand(0,10)
        	]);
        }
    }

    function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

}
