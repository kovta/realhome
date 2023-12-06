<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTownDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_town_districts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('location_area_id');
            $table->string('name', 150);
            $table->timestamps();

            $table->foreign('location_area_id')->references('id')->on('location_areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_town_districts');
    }
}
