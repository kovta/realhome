<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealEstateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id')->nullable();
            $table->string('name', 200)->nullable();
            $table->smallInteger('offer_status_enum')->default(1);
            $table->smallInteger('language_enum')->nullable();
            $table->tinyInteger('maps_included')->nullable();
            $table->tinyInteger('street_address_included')->nullable();
            $table->tinyInteger('crop_logo_included')->nullable();
            $table->tinyInteger('one_page_limit')->nullable();
            //FK
            $table->unsignedInteger('created_by_id')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estate_offers');
    }
}
