<?php

use Illuminate\Database\Seeder;
use \App\Models\Enum\RealEstateStatusEnum;
use \App\Models\Enum\RealEstateWebStatusEnum;
use \App\Models\Enum\RealEstateContractTypeEnum;
use \App\Models\Enum\RealEstateStateEnum;
use \App\Models\Enum\RealEstateGardenTypeEnum;
use \App\Models\Enum\RealEstateHouseSubTypeEnum;
use \App\Models\Enum\RealEstateRetailUnitLocationEnum;
use \App\Models\Enum\RealEstateOrientationEnum;
use \App\Models\Enum\RealEstateVistaEnum;
use \App\Models\Enum\RealEstateHeatingTypeEnum;
use \App\Models\Enum\RealEstateKitchenTypeEnum;
use \App\Models\Enum\RealEstateFurnitureEnum;



class RealEstateSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $felujitandoCsaladihazKerttel = array(
            'code' => '2019/123456',
            'status_enum' => RealEstateStatusEnum::aktualis,
            'web_status_enum' => RealEstateWebStatusEnum::kiemelt,
            'contract_type_enum' => RealEstateContractTypeEnum::elado,
// nincs szerzi
            'commission' => 0,
            'commission_contract_id' => null,

            // ingatlan tipus...
            'real_estate_state_enum' => RealEstateStateEnum::felujitando,
// lakóház
            'real_estate_type_id' => 1,
            'real_estate_garden_type_enum' => RealEstateGardenTypeEnum::privat,
            'garden_size' => 150,
            'lot_size' => 200,
            'real_estate_house_sub_type_enum' => RealEstateHouseSubTypeEnum::csaladiHaz,
            'real_estate_retail_unit_location_enum' => RealEstateRetailUnitLocationEnum::utcaiBejarat,
            'real_estate_office_location_enum' => null,
            'real_estate_warehouse_sub_type_enum' => null,
            'real_estate_catering_sub_type_enum' => null,
            'real_estate_industrial_sub_type_enum' => null,
            'real_estate_agricultural_sub_type_enum' => null,
            'real_estate_development_site_enum' => null,
            'location_area_id' => null,
            'street_address_1' => 'cím 1',
            'street_address_2' => 'cím 2',
            'street_address_3' => 'cím 3',
            'floor' => 1.00,
            'real_estate_orientation_enum' => RealEstateOrientationEnum::delNyugati,
            'real_estate_vista_enum' => RealEstateVistaEnum::udvarra,

            //kozmuvek, stb...
            'utilities' => 1,
            'real_estate_heating_type_enum' => RealEstateHeatingTypeEnum::gazKonvektor,
            'base_area_gross' => 150,
            'number_levels' => 2,
            'living_room_size' => 80,
            'base_area_net' => 147,
            'number_bedroom' => 3,
            'real_estate_kitchen_type_enum' => RealEstateKitchenTypeEnum::openPlanDiningRoom,
            'real_estate_furniture_enum' => RealEstateFurnitureEnum::butorozatlan,
            'number_bath' => 2,
            'number_shower' => 1,
            'number_wc' => 2,
            'number_garage' => 2,
            'number_parking' => 2,
            'balcony' => 1,
            'balcony_size' => 8,
            'terrace' => 2,
            'terrace_size' => 30,
            'roof_terrace' => 0,
            'roof_terrace_size' => 0,

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

            // tulajdonos
            'owner_name' => 'Tulajdonos Neve',
            'owner_email' => 'tulajdonos@email.je',
            'owner_phone_1' => 'telefon_1',
            'owner_phone_2' => 'telefon_2',
            'owner_contact_name' => 'Kapcsolat Neve',
            'owner_contact_phone' => 'kapcsolat tel',
            'owner_contact_email' => 'kapcsolat@email.je',
            'owner_bell' => 'csengő',
            'owner_alarm' => 'riasztó kód',
            'owner_keys' => 1,
            'comment' => 'komment',

            // koltsegek
            'price_currency_id' => 1,
            'operation_fee' => 100000,
            'common_area_mult' => 1,
            'common_charge' => 0,

            // valami
            'moveindate' => '2019-09-23',
            'last_owner_contact_noify_sent' => '2019-09-01',
            'place_number' => '1324/54654',
            'build_year' => '2012',
            'renovation_year' => '2018',
            'offer_price' => 45000000,
            'limit_price' => 40000000,

            // translated fields
            'locales' => array(
                'hu' => array(
                    'marketing_name' => 'csendes családi fészek',
                    'description' => 'megjegyzés magyar',
                ),
                'en' => array(
                    'marketing_name' => 'quiet family nest',
                    'description' => 'description in english',
                ),
            ),

            'created_by_id' => 2,
            'created_at' => '2019-05-18 13:48:05',
            'score' => 5,
        );

        //-----------------------------------------------------------------------

        $ujepitesuCsaladihazKerttel = array(
            'code' => '2019/234',
            'status_enum' => RealEstateStatusEnum::aktualis,
            'web_status_enum' => RealEstateWebStatusEnum::kiemelt,
            'contract_type_enum' => RealEstateContractTypeEnum::elado,
// nincs szerzi
            'commission' => 0,
            'commission_contract_id' => null,

            // ingatlan tipus...
            'real_estate_state_enum' => RealEstateStateEnum::ujepitesu,
// lakóház
            'real_estate_type_id' => 1,
            'real_estate_garden_type_enum' => RealEstateGardenTypeEnum::privat,
            'garden_size' => 100,
            'lot_size' => 170,
            'real_estate_house_sub_type_enum' => RealEstateHouseSubTypeEnum::csaladiHaz,
            'real_estate_retail_unit_location_enum' => RealEstateRetailUnitLocationEnum::utcaiBejarat,
            'real_estate_office_location_enum' => null,
            'real_estate_warehouse_sub_type_enum' => null,
            'real_estate_catering_sub_type_enum' => null,
            'real_estate_industrial_sub_type_enum' => null,
            'real_estate_agricultural_sub_type_enum' => null,
            'real_estate_development_site_enum' => null,
            'location_area_id' => null,
            'street_address_1' => 'cím 1',
            'street_address_2' => 'cím 2',
            'street_address_3' => 'cím 3',
            'floor' => 1.00,
            'real_estate_orientation_enum' => RealEstateOrientationEnum::nyugati,
            'real_estate_vista_enum' => RealEstateVistaEnum::udvarra,

            //kozmuvek, stb...
            'utilities' => 1,
            'real_estate_heating_type_enum' => RealEstateHeatingTypeEnum::gazCirko,
            'base_area_gross' => 120,
            'number_levels' => 2,
            'living_room_size' => 80,
            'base_area_net' => 147,
            'number_bedroom' => 3,
            'real_estate_kitchen_type_enum' => RealEstateKitchenTypeEnum::openPlanDiningRoom,
            'real_estate_furniture_enum' => RealEstateFurnitureEnum::butorozatlan,
            'number_bath' => 2,
            'number_shower' => 1,
            'number_wc' => 2,
            'number_garage' => 2,
            'number_parking' => 2,
            'balcony' => 1,
            'balcony_size' => 8,
            'terrace' => 2,
            'terrace_size' => 30,
            'roof_terrace' => 0,
            'roof_terrace_size' => 0,

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
            'outdoor_pool' => 1,
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

            // tulajdonos
            'owner_name' => 'Tulajdonos Neve',
            'owner_email' => 'tulajdonos@email.je',
            'owner_phone_1' => 'telefon_1',
            'owner_phone_2' => 'telefon_2',
            'owner_contact_name' => 'Kapcsolat Neve',
            'owner_contact_phone' => 'kapcsolat tel',
            'owner_contact_email' => 'kapcsolat@email.je',
            'owner_bell' => 'csengő',
            'owner_alarm' => 'riasztó kód',
            'owner_keys' => 1,
            'comment' => 'komment',

            // koltsegek
            'price_currency_id' => 1,
            'operation_fee' => 100000,
            'common_area_mult' => 1,
            'common_charge' => 0,

            // valami
            'moveindate' => '2019-09-23',
            'last_owner_contact_noify_sent' => '2019-09-01',
            'place_number' => '1324/54654',
            'build_year' => '2019',
            'renovation_year' => null,
            'offer_price' => 50000000,
            'limit_price' => 42000000,

            // translated fields
            'locales' => array(
                'hu' => array(
                    'marketing_name' => 'újépítésű családi',
                    'description' => 'megjegyzés magyar',
                ),
                'en' => array(
                    'marketing_name' => 'a new family home',
                    'description' => 'description in english',
                ),
            ),

            'created_by_id' => 2,
            'created_at' => '2019-05-18 13:48:05',
            'score' => 5,
        );

        //-----------------------------------------------------------------------

        $felujitottTetoteraszosLakas = array(
            'code' => '2019/2345',
            'status_enum' => RealEstateStatusEnum::aktualis,
            'web_status_enum' => RealEstateWebStatusEnum::kiemelt,
            'contract_type_enum' => RealEstateContractTypeEnum::kiado,
// nincs szerzi
            'commission' => 0,
            'commission_contract_id' => null,

            // ingatlan tipus...
            'real_estate_state_enum' => RealEstateStateEnum::felujitott,
// lakás
            'real_estate_type_id' => 2,
            'real_estate_garden_type_enum' => RealEstateGardenTypeEnum::nincs,
            //'garden_size' => 100,
            //'lot_size' => 170,
            //'real_estate_house_sub_type_enum' => RealEstateHouseSubTypeEnum::csaladiHaz,
            'real_estate_retail_unit_location_enum' => RealEstateRetailUnitLocationEnum::udvariBejarat,
            'real_estate_office_location_enum' => null,
            'real_estate_warehouse_sub_type_enum' => null,
            'real_estate_catering_sub_type_enum' => null,
            'real_estate_industrial_sub_type_enum' => null,
            'real_estate_agricultural_sub_type_enum' => null,
            'real_estate_development_site_enum' => null,
            'location_area_id' => null,
            'street_address_1' => 'cím 1',
            'street_address_2' => 'cím 2',
            'street_address_3' => 'cím 3',
            'floor' => 4.00,
            'real_estate_orientation_enum' => RealEstateOrientationEnum::nyugati,
            'real_estate_vista_enum' => RealEstateVistaEnum::panoramas,

            //kozmuvek, stb...
            'utilities' => 1,
            'real_estate_heating_type_enum' => RealEstateHeatingTypeEnum::gazCirko,
            'base_area_gross' => 100,
            'number_levels' => 2,
            'living_room_size' => 80,
            'base_area_net' => 147,
            'number_bedroom' => 2,
            'real_estate_kitchen_type_enum' => RealEstateKitchenTypeEnum::openPlanDiningRoom,
            'real_estate_furniture_enum' => RealEstateFurnitureEnum::butorozott,
            'number_bath' => 2,
            'number_shower' => 1,
            'number_wc' => 2,
            'number_garage' => 2,
            'number_parking' => 2,
            'balcony' => 1,
            'balcony_size' => 8,
            'terrace' => 0,
            'terrace_size' => 0,
            'roof_terrace' => 1,
            'roof_terrace_size' => 15,

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
            'elevator' => 1,
            'panoramic_view' => 1,
            'danube_view' => 0,
            'winter_garden' => 0,
            'irrigation' => 0,
            'en_suit_bathroom' => 0,
            'laundry' => 0,
            'cellar' => 0,
            'hard_wood_flooring' => 1,
            'floor_heating' => 0,
            'high_ceiling' => 0,
            'central_vacuum_cleaner' => 0,
            'accessibility' => 0,

            // tulajdonos
            'owner_name' => 'Tulajdonos Neve',
            'owner_email' => 'tulajdonos@email.je',
            'owner_phone_1' => 'telefon_1',
            'owner_phone_2' => 'telefon_2',
            'owner_contact_name' => 'Kapcsolat Neve',
            'owner_contact_phone' => 'kapcsolat tel',
            'owner_contact_email' => 'kapcsolat@email.je',
            'owner_bell' => 'csengő',
            'owner_alarm' => 'riasztó kód',
            'owner_keys' => 1,
            'comment' => 'komment',

            // koltsegek
            'price_currency_id' => 1,
            'operation_fee' => 100000,
            'common_area_mult' => 1,
            'common_charge' => 0,

            // valami
            'moveindate' => '2019-07-01',
            'last_owner_contact_noify_sent' => '2019-09-01',
            'place_number' => '1324/54654',
            'build_year' => '2010',
            'renovation_year' => 2018,
            'offer_price' => 55000000,
            'limit_price' => 50000000,

            // translated fields
            'locales' => array(
                'hu' => array(
                    'marketing_name' => 'tetőteraszos álom',
                    'description' => 'megjegyzés magyar',
                ),
                'en' => array(
                    'marketing_name' => 'roof terrace dreamhouse',
                    'description' => 'description in english',
                ),
            )
        );

        //-----------------------------------------------------------------------


        $sorhaziLakas = array(
            'code' => '2019/22222',
            'status_enum' => RealEstateStatusEnum::aktualis,
            'web_status_enum' => RealEstateWebStatusEnum::kiemelt,
            'contract_type_enum' => RealEstateContractTypeEnum::kiado,
// nincs szerzi
            'commission' => 0,
            'commission_contract_id' => null,

            // ingatlan tipus...
            'real_estate_state_enum' => RealEstateStateEnum::ujszeru,
// lakás
            'real_estate_type_id' => 1,
            'real_estate_garden_type_enum' => RealEstateGardenTypeEnum::nincs,
            //'garden_size' => 100,
            //'lot_size' => 170,
            'real_estate_house_sub_type_enum' => RealEstateHouseSubTypeEnum::sorHaz,
            'real_estate_retail_unit_location_enum' => RealEstateRetailUnitLocationEnum::utcaiBejarat,
            'real_estate_office_location_enum' => null,
            'real_estate_warehouse_sub_type_enum' => null,
            'real_estate_catering_sub_type_enum' => null,
            'real_estate_industrial_sub_type_enum' => null,
            'real_estate_agricultural_sub_type_enum' => null,
            'real_estate_development_site_enum' => null,
            'location_area_id' => null,
            'street_address_1' => 'cím 1',
            'street_address_2' => 'cím 2',
            'street_address_3' => 'cím 3',
            'floor' => 4.00,
            'real_estate_orientation_enum' => RealEstateOrientationEnum::eszakNyugati,
            'real_estate_vista_enum' => RealEstateVistaEnum::parkra,

            //kozmuvek, stb...
            'utilities' => 1,
            'real_estate_heating_type_enum' => RealEstateHeatingTypeEnum::egyebKazan,
            'base_area_gross' => 85,
            'number_levels' => 2,
            'living_room_size' => 80,
            'base_area_net' => 147,
            'number_bedroom' => 2,
            'real_estate_kitchen_type_enum' => RealEstateKitchenTypeEnum::openPlanDiningRoom,
            'real_estate_furniture_enum' => RealEstateFurnitureEnum::butorozott,
            'number_bath' => 2,
            'number_shower' => 1,
            'number_wc' => 2,
            'number_garage' => 2,
            'number_parking' => 2,
            'balcony' => 1,
            'balcony_size' => 8,
            'terrace' => 0,
            'terrace_size' => 0,
            'roof_terrace' => 1,
            'roof_terrace_size' => 15,

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
            'elevator' => 1,
            'panoramic_view' => 1,
            'danube_view' => 0,
            'winter_garden' => 0,
            'irrigation' => 0,
            'en_suit_bathroom' => 0,
            'laundry' => 0,
            'cellar' => 0,
            'hard_wood_flooring' => 1,
            'floor_heating' => 0,
            'high_ceiling' => 0,
            'central_vacuum_cleaner' => 0,
            'accessibility' => 0,

            // tulajdonos
            'owner_name' => 'Tulajdonos Neve',
            'owner_email' => 'tulajdonos@email.je',
            'owner_phone_1' => 'telefon_1',
            'owner_phone_2' => 'telefon_2',
            'owner_contact_name' => 'Kapcsolat Neve',
            'owner_contact_phone' => 'kapcsolat tel',
            'owner_contact_email' => 'kapcsolat@email.je',
            'owner_bell' => 'csengő',
            'owner_alarm' => 'riasztó kód',
            'owner_keys' => 1,
            'comment' => 'komment',

            // koltsegek
            'price_currency_id' => 1,
            'operation_fee' => 100000,
            'common_area_mult' => 1,
            'common_charge' => 0,

            // valami
            'moveindate' => '2019-07-01',
            'last_owner_contact_noify_sent' => '2019-09-01',
            'place_number' => '1324/54654',
            'build_year' => '2010',
            'renovation_year' => 2018,
            'offer_price' => 35000000,
            'limit_price' => 30000000,

            // translated fields
            'locales' => array(
                'hu' => array(
                    'marketing_name' => 'sorházi lakás',
                    'description' => 'megjegyzés magyar',
                ),
                'en' => array(
                    'marketing_name' => 'rowhouses',
                    'description' => 'description in english',
                ),
            ),

            'score' => 5,
        );


        //-----------------------------------------------------------------------




        $recordDescriptor = array(
            $felujitandoCsaladihazKerttel,
            $ujepitesuCsaladihazKerttel,
            $felujitottTetoteraszosLakas,
            $sorhaziLakas,
        );

        foreach ($recordDescriptor as $item) {
            $fields = $item;
            unset($fields['locales']);
            $idWas = DB::table('real_estates')->insertGetId($fields);
//            $idWas = DB::table('real_estates')->insertGetId([
//                'real_estate_category_id' => $item['cat'],
//            ]);
            foreach ($item['locales'] as $locale => $data) {
                DB::table('real_estate_translations')->insert([
                    'real_estate_id' => $idWas,
                    'locale' => $locale,
                    'marketing_name' => $data['marketing_name'],
                    'description' => $data['description'],
                ]);
            }
        }

    }
}
