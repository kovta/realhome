<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estates', function (Blueprint $table) {
            // doksiban: fej adatok --------------------------------------------------------------------------
            $table->increments('id');
            $table->timestamps();
            $table->string('code', 30)->nullable();
            $table->integer('status_enum')->nullable();                          // nalunk enum
            $table->integer('web_status_enum')->nullable();                      // nalunk enum
            //$table->dateTime('created');                                               // ezt lefedi a timestamps...
            //FK
            $table->unsignedInteger('created_by_id')->nullable();

            //$table->dateTime('last_modified');                                         // ezt lefedi a timestamps...
            $table->smallInteger('commission')->nullable();
            // FK
            $table->unsignedInteger('commission_contract_id')->nullable();       // documents

            $table->smallInteger('presentable')->default(0);
            $table->date('moveindate')->nullable();

            $table->integer('score')->nullable();
            //$table->smallInteger('water_marked_photos'); nem kell !!!
            $table->bigInteger('web_appearances')->nullable();
            $table->bigInteger('web_interestes')->nullable();

            //helyette inkább: marketing_name, string(200), translated - megvan
            //$table->unsignedInteger('marketing_name_id')->nullable();

            $table->date('last_owner_contact_noify_sent')->nullable();

            // doksiban: alap adatok --------------------------------------------------------------------------
            $table->integer('contract_type_enum')->nullable();                     // nalunk enum
            // FK
            $table->unsignedInteger('location_area_id')->nullable();
            // FK
            $table->unsignedInteger('location_town_district_id')->nullable();
            // FK
            $table->unsignedInteger('location_neighborhood_id')->nullable();

            $table->string('street_address_1', 200)->nullable();
            $table->string('street_address_2', 200)->nullable();
            $table->string('street_address_3', 100)->nullable();
            $table->string('place_number', 50)->nullable();
            // FK
            $table->unsignedInteger('real_estate_type_id')->nullable();

            $table->integer('base_area_gross')->nullable();
            $table->integer('base_area_net')->nullable();
            $table->integer('lot_size')->nullable();
            // FK
            $table->unsignedInteger('price_currency_id')->nullable();

            $table->float('offer_price', 16, 2)->nullable();
            $table->float('limit_price', 16, 2)->nullable();
            $table->integer('build_year')->nullable();
            $table->integer('renovation_year')->nullable();

            // helyette inkább: description, text, translated - megvan
            //$table->unsignedInteger('description');

            // doksiban: kiegészitő adatok --------------------------------------------------------------------------
            $table->smallInteger('real_estate_orientation_enum')->nullable();                    // nalunk enum
            $table->smallInteger('real_estate_vista_enum')->nullable();                          // nalunk enum

            $table->smallInteger('utilities')->nullable();
            $table->integer('number_levels')->nullable();
            $table->float('floor', 3, 1)->nullable();
            $table->integer('living_room_size')->nullable();
            $table->integer('number_bedroom')->nullable();

            $table->smallInteger('real_estate_kitchen_type_enum')->nullable();                          // nalunk enum
            $table->smallInteger('real_estate_furniture_enum')->nullable();                          // nalunk enum

            $table->smallInteger('number_bath')->nullable();
            $table->smallInteger('number_shower')->nullable();
            $table->smallInteger('number_wc')->nullable();
            $table->smallInteger('common_charge')->nullable();  // közös ktsg. miert nem float?

            $table->smallInteger('real_estate_garden_type_enum')->nullable();                          // nalunk enum

            $table->smallInteger('garden_size')->nullable();
            $table->smallInteger('number_garage')->nullable();
            $table->smallInteger('number_parking')->nullable();


            $table->smallInteger('real_estate_heating_type_enum')->nullable();                          // nalunk enum
            $table->smallInteger('real_estate_state_enum')->nullable();                                 // nalunk enum
            $table->smallInteger('real_estate_house_sub_type_enum')->nullable();                        // nalunk enum
            $table->smallInteger('real_estate_retail_unit_location_enum')->nullable();                  // nalunk enum
            $table->smallInteger('real_estate_office_location_enum')->nullable();                       // nalunk enum
            $table->smallInteger('real_estate_warehouse_sub_type_enum')->nullable();                    // nalunk enum
            $table->smallInteger('real_estate_catering_sub_type_enum')->nullable();                     // nalunk enum
            $table->smallInteger('real_estate_industrial_sub_type_enum')->nullable();                   // nalunk enum
            $table->smallInteger('real_estate_agricultural_sub_type_enum')->nullable();                 // nalunk enum
            $table->smallInteger('real_estate_development_site_enum')->nullable();                      // nalunk enum

            $table->integer('operation_fee')->nullable();  // üzem. ktsg. miert nem float?
            $table->float('common_area_mult', 16, 2)->nullable();

            // doksiban: felszereltség adatok --------------------------------------------------------------------------
            $table->tinyInteger('domestic_animal_allowed')->default(0)->nullable();
            $table->tinyInteger('pet_allowed')->default(0)->nullable();
            $table->tinyInteger('alarm_system')->default(0)->nullable();
            $table->tinyInteger('airconditioning')->default(0)->nullable();
            $table->tinyInteger('fireplace')->default(0)->nullable();
            $table->tinyInteger('cabletv')->default(0)->nullable();
            $table->tinyInteger('satellite_system')->default(0)->nullable();
            $table->tinyInteger('internet')->default(0)->nullable();
            $table->tinyInteger('security_service_24h')->default(0)->nullable();
            $table->tinyInteger('indoor_pool')->default(0)->nullable();
            $table->tinyInteger('outdoor_pool')->default(0)->nullable();
            $table->tinyInteger('jacuzzi')->default(0)->nullable();
            $table->tinyInteger('sauna')->default(0)->nullable();
            $table->tinyInteger('hobby_room_gim')->default(0)->nullable();
            $table->tinyInteger('guest_apartment')->default(0)->nullable();
            $table->tinyInteger('elevator')->default(0)->nullable();
            $table->tinyInteger('panoramic_view')->default(0)->nullable();
            $table->tinyInteger('danube_view')->default(0)->nullable();
            $table->tinyInteger('balcony')->default(0)->nullable();
            $table->integer('balcony_size')->nullable();
            $table->tinyInteger('terrace')->default(0)->nullable();
            $table->integer('terrace_size')->nullable();
            $table->tinyInteger('roof_terrace')->default(0)->nullable();
            $table->integer('roof_terrace_size')->nullable();
            $table->tinyInteger('winter_garden')->default(0)->nullable();
            $table->tinyInteger('irrigation')->default(0)->nullable();
            $table->tinyInteger('en_suit_bathroom')->default(0)->nullable();
            $table->tinyInteger('laundry')->default(0)->nullable();
            $table->tinyInteger('cellar')->default(0)->nullable();
            $table->tinyInteger('hard_wood_flooring')->default(0)->nullable();
            $table->tinyInteger('floor_heating')->default(0)->nullable();
            $table->tinyInteger('high_ceiling')->default(0)->nullable();
            $table->tinyInteger('central_vacuum_cleaner')->default(0)->nullable();
            $table->tinyInteger('accessibility')->default(0)->nullable();

            // doksiban: tulajdonos adatok --------------------------------------------------------------------------
            $table->string('owner_name', 200)->nullable();
            $table->string('owner_phone_1', 30)->nullable();
            $table->string('owner_phone_2', 30)->nullable();
            $table->string('owner_email', 200)->nullable();
            $table->string('owner_contact_name', 200)->nullable();
            $table->string('owner_contact_phone', 30)->nullable();
            $table->string('owner_contact_email', 200)->nullable();
            $table->string('owner_bell', 50)->nullable();
            $table->string('owner_alarm', 100)->nullable();
            $table->tinyInteger('owner_keys')->nullable();
            $table->text('comment')->nullable();


            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('location_area_id')->references('id')->on('location_areas')->onDelete('set null');
            $table->foreign('location_town_district_id')->references('id')->on('location_town_districts')->onDelete('set null');
            $table->foreign('location_neighborhood_id')->references('id')->on('location_neighborhoods')->onDelete('set null');
            $table->foreign('real_estate_type_id')->references('id')->on('real_estate_types')->onDelete('set null');
            $table->foreign('price_currency_id')->references('id')->on('currencies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estates');
    }
}
