<?php

use Illuminate\Database\Seeder;

class LocationNeighborhoodSeeder extends Seeder
{
    const district3 = 2;
    const district15 = 3;
    const district16 = 4;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    $recordDescriptor = array(
        array('name'=>'Békásmegyer', 'district'=>self::district3),
        array('name'=>'Csillaghegy', 'district'=>self::district3),
        array('name'=>'Rákospalota', 'district'=>self::district15),
        array('name'=>'Mátyásföld', 'district'=>self::district16),
    );

    foreach ($recordDescriptor as $item) {
        DB::table('location_neighborhoods')->insert([
            'location_town_district_id' => $item['district'],
            'name' => $item['name'],
        ]);
    }

}
}
