<?php

use Illuminate\Database\Seeder;
use \App\Models\Enum\RealEstateCategoryEnum;


class RealEstateTypeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recordDescriptor = array(

            array('cat'=>RealEstateCategoryEnum::lakoIngatlan,
                'locales' => array(
                    'hu' => 'lakóház',
                    'en' => 'House',
                )
            ),
            array('cat'=>RealEstateCategoryEnum::lakoIngatlan,
                'green_box' => true,
                'locales' => array(
                    'hu' => 'lakás',
                    'en' => 'Apartment',
                )
            ),
            array('cat'=>RealEstateCategoryEnum::lakoIngatlan,
                'locales' => array(
                    'hu' => 'nyaraló',
                    'en' => 'Vacation home',
                )
            ),
            array('cat'=>RealEstateCategoryEnum::lakoIngatlan,
                'locales' => array(
                    'hu' => 'telek (lakóövezet)',
                    'en' => 'Lot (residental zone)',
                )
            ),
            array('cat'=>RealEstateCategoryEnum::kereskedelmiIngatlan,
                'green_box' => true,
                'locales' => array(
                    'hu' => 'üzlethelyiség',
                    'en' => 'Rental unit',
                )
            ),
            array('cat'=>RealEstateCategoryEnum::kereskedelmiIngatlan,
                'green_box' => true,
                'locales' => array(
                    'hu' => 'iroda',
                    'en' => 'Office',
                )
            ),
            array('cat'=>RealEstateCategoryEnum::kereskedelmiIngatlan,
                'locales' => array(
                    'hu' => 'raktár',
                    'en' => 'Warehouse',
                )
            ),
            array('cat'=>RealEstateCategoryEnum::kereskedelmiIngatlan,
                'green_box' => true,
                'locales' => array(
                    'hu' => 'vendéglátóipari',
                    'en' => 'Catering',
                )
            ),
            array('cat'=>RealEstateCategoryEnum::kereskedelmiIngatlan,
                'locales' => array(
                    'hu' => 'ipari',
                    'en' => 'Industrial',
                )
            ),
            array('cat'=>RealEstateCategoryEnum::kereskedelmiIngatlan,
                'green_box' => true,
                'locales' => array(
                    'hu' => 'garázs',
                    'en' => 'Garage',
                )
            ),
            array('cat'=>RealEstateCategoryEnum::kereskedelmiIngatlan,
                'locales' => array(
                    'hu' => 'telek (kereskedelmi övezet)',
                    'en' => 'Lot (commercial zone)',
                )
            ),
            array('cat'=>RealEstateCategoryEnum::kereskedelmiIngatlan,
                'locales' => array(
                    'hu' => 'mezőgazdasági',
                    'en' => 'Agricultural',
                )
            ),
            array('cat'=>RealEstateCategoryEnum::kereskedelmiIngatlan,
                'locales' => array(
                    'hu' => 'fejlesztési',
                    'en' => 'Development site',
                )
            ),
        );


        foreach ($recordDescriptor as $item) {
            if (isset($item['green_box'])) {
                $idWas = DB::table('real_estate_types')->insertGetId([
                    'real_estate_category_id' => $item['cat'],
                    'real_estate_offer_pdf_green_box' => $item['green_box'],
                ]);
            } else {
                $idWas = DB::table('real_estate_types')->insertGetId([
                    'real_estate_category_id' => $item['cat'],
                ]);
            }
            foreach ($item['locales'] as $locale => $name) {
                DB::table('real_estate_type_translations')->insert([
                    'real_estate_type_id' => $idWas,
                    'locale' => $locale,
                    'name' => $name,
                ]);
            }
        }
    }
}
