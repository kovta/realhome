<?php

use Illuminate\Database\Seeder;

class LocationTownDistrictSeeder extends Seeder
{

    const locAreaBudapest = 1;
    const locAreaBPagglo = 2;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recordDescriptor = array(
            array('name'=>'Budapest 1. ker.', 'area'=>self::locAreaBudapest),
            array('name'=>'Budapest 3. ker.', 'area'=>self::locAreaBudapest),
            array('name'=>'Budapest 15. ker.', 'area'=>self::locAreaBudapest),
            array('name'=>'Budapest 16. ker.', 'area'=>self::locAreaBudapest),

            array('name'=>'Üllő', 'area'=>self::locAreaBPagglo),
            array('name'=>'Kistarcsa', 'area'=>self::locAreaBPagglo),
            array('name'=>'Gyál', 'area'=>self::locAreaBPagglo),
            array('name'=>'Szigetszentmiklós', 'area'=>self::locAreaBPagglo),
        );

        foreach ($recordDescriptor as $item) {
            DB::table('location_town_districts')->insert([
                'location_area_id' => $item['area'],
                'name' => $item['name'],
            ]);
        }

    }
}
