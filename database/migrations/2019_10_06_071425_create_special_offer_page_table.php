<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialOfferPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_offer_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->integer('position')->nullable();

            $table->integer('contract_type_enum')->nullable();
            $table->unsignedInteger('real_estate_type_id')->nullable();
            $table->unsignedInteger('location_area_id')->nullable();
            $table->unsignedInteger('location_town_district_id')->nullable();
            $table->unsignedInteger('location_neighborhood_id')->nullable();
            $table->integer('price_min')->default(0)->nullable();
            $table->integer('price_max')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_offer_pages');
    }
}
