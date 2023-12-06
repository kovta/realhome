<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recordDescriptor = array(

            array(
                'iso_code' => 'HUF',
                'rate' => 1.0
            ),
            array(
                'iso_code' => 'EUR',
                'rate' => 300.0
            ),
            array(
                'iso_code' => 'USD',
                'rate' => 300.0
            ),

        );

        foreach ($recordDescriptor as $item) {
            $idWas = DB::table('currencies')->insertGetId($item);
        }
    }
}
