<?php

use Illuminate\Database\Seeder;

class AdvertisingPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('advertising_partners')->insert([
            'name' => 'Hirdető partner 1'
        ]);

        DB::table('advertising_partners')->insert([
            'name' => 'Hirdető partner 2'
        ]);
    }
}
