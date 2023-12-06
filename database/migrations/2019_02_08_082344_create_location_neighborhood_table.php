<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationNeighborhoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_neighborhoods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('location_town_district_id');
            $table->string('name', 150);
            $table->timestamps();

            $table->foreign('location_town_district_id')->references('id')->on('location_town_districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_neighborhoods');
    }
}
