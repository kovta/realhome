<?php

use Illuminate\Database\Seeder;

class LocationAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('location_areas')->insert([
            'name' => 'Budapest'
        ]);
        DB::table('location_areas')->insert([
            'name' => 'Budapest aggló'
        ]);
    }
}
