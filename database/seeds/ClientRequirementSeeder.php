<?php

use Illuminate\Database\Seeder;
use \App\Models\Enum\RealEstateStatusEnum;
use \App\Models\Enum\RealEstateContractTypeEnum;

class ClientRequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recordDescriptor = array(

            // Kliens Katat ez erdekli...
            array(
                'status_enum' => RealEstateStatusEnum::aktualis,
                'contract_type_enum' => RealEstateContractTypeEnum::elado,
                'client_id' => 1,
                // lakóház
                'real_estate_type_id' => 1,
                'location_area_id' => null,
                'price_min' => 40000000,
                'price_max' => 52000000,
                'price_currency_id' => 1,
                'build_year_min' => 2010,
                'build_year_max' => null,
                'gross_base_area_min' => null,
                'gross_base_area_max' => null,
                'score_min' => null,
                'floor_min' => null,
                'floor_max' => null,
                'number_bedroom_min' => null,
                'number_bedroom_max' => null,
                'number_bath_min' => null,
                'livingroom_size_min' => null,
                'furniture' => null,
                //'kitchen' => null,
                'garden' => null,
                'number_garage_plus_parking' => null,

                // felszereltseg
                'pet_allowed' => 1,
                'small_pet_allowed' => 1,
                'alarm_system' => 1,
                'airconditioning' => 1,
                'fireplace' => 1,
                'cabletv' => 1,
                'satellite_system' => 0,
                'internet' => 1,
                'security_service_24h' => 0,
                'indoor_pool' => 0,
                'outdoor_pool' => 0,
                'jacuzzi' => 0,
                'sauna' => 0,
                'hobby_room_gim' => 0,
                'guest_apartment' => 0,
                'elevator' => 0,
                'panoramic_view' => 0,
                'danube_view' => 0,
                'winter_garden' => 0,
                'irrigation' => 1,
                'en_suit_bathroom' => 0,
                'laundry' => 1,
                'cellar' => 1,
                'hard_wood_flooring' => 0,
                'floor_heating' => 0,
                'high_ceiling' => 0,
                'central_vacuum_cleaner' => 0,
                'accessibility' => 0,
            ),

        );

        foreach ($recordDescriptor as $item) {
            DB::table('client_requirements')->insert($item);
        }
    }
}
