<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientRequirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('status_enum')->nullable();
            $table->integer('contract_type_enum')->nullable();
            // FK
            $table->unsignedInteger('client_id')->nullable();
            // FK
            $table->unsignedInteger('real_estate_type_id')->nullable();
            // FK
            $table->unsignedInteger('location_area_id')->nullable();
            // FK
            $table->unsignedInteger('location_town_district_id')->nullable();
            // FK
            $table->unsignedInteger('location_neighborhood_id')->nullable();

            $table->integer('price_min')->default(0)->nullable();
            $table->integer('price_max')->default(0)->nullable();

            $table->unsignedInteger('price_currency_id')->nullable();

            $table->integer('build_year_min')->default(0)->nullable();
            $table->integer('build_year_max')->default(0)->nullable();

            $table->integer('gross_base_area_min')->default(0)->nullable();
            $table->integer('gross_base_area_max')->default(0)->nullable();

            $table->integer('score_min')->default(0)->nullable();

            $table->integer('floor_min')->default(0)->nullable();
            $table->integer('floor_max')->default(0)->nullable();

            $table->integer('number_bedroom_min')->default(0)->nullable();
            $table->integer('number_bedroom_max')->default(0)->nullable();

            $table->integer('number_bath_min')->default(0)->nullable();
            $table->integer('livingroom_size_min')->default(0)->nullable();
            $table->tinyInteger('furniture')->nullable();
            // kitchen_type_enum - client_requirement_kitchen_types tabla
            $table->tinyInteger('garden')->nullable();

            $table->integer('number_garage_plus_parking')->default(0)->nullable();


            // doksiban: felszereltség adatok --------------------------------------------------------------------------
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


            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->foreign('real_estate_type_id')->references('id')->on('real_estate_types')->onDelete('set null');
            $table->foreign('location_area_id')->references('id')->on('location_areas')->onDelete('set null');
            $table->foreign('location_town_district_id')->references('id')->on('location_town_districts')->onDelete('set null');
            $table->foreign('location_neighborhood_id')->references('id')->on('location_neighborhoods')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_requirements');
    }
}
