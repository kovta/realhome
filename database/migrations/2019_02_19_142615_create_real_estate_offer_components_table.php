<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealEstateOfferComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_offer_components', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('offer_id')->nullable();
            $table->unsignedInteger('real_estate_id')->nullable();

            $table->foreign('offer_id')->references('id')->on('real_estate_offers')->onDelete('cascade');
            $table->foreign('real_estate_id')->references('id')->on('real_estates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estate_offer_components');
    }
}
