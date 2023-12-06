<?php

use Illuminate\Database\Seeder;
use \App\Models\Enum\RealEstateOfferStatusEnum;
use \App\Models\Enum\LanguageEnum;

class RealEstateOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recordDescriptor = array(

            array('name' => 'TEST1',
                'client_id' => null,
                'offer_status_enum' => RealEstateOfferStatusEnum::mentett,
                'language_enum' => LanguageEnum::magyar,
                'maps_included' => 0,
                'street_address_included' => 0,
                'crop_logo_included' => 0,
                'one_page_limit' => 0,
                'created_by_id' => 2,
            ),
            array('name' => 'TEST2',
                'client_id' => 1,
                'offer_status_enum' => RealEstateOfferStatusEnum::mentett,
                'language_enum' => LanguageEnum::magyar,
                'maps_included' => 0,
                'street_address_included' => 0,
                'crop_logo_included' => 0,
                'one_page_limit' => 0,
                'created_by_id' => 6,
            ),
            array('name' => 'TEST3',
                'client_id' => 1,
                'offer_status_enum' => RealEstateOfferStatusEnum::mentett,
                'language_enum' => LanguageEnum::magyar,
                'maps_included' => 0,
                'street_address_included' => 0,
                'crop_logo_included' => 0,
                'one_page_limit' => 0,
                'created_by_id' => 6,
            ),

        );

        foreach ($recordDescriptor as $item) {
            $idWas = DB::table('real_estate_offers')->insertGetId($item);
        }
    }
}
