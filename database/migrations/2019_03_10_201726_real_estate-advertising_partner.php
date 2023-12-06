<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RealEstateAdvertisingPartner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estates_advertising_partners', function(Blueprint $table){
            $table->unsignedInteger('real_estate_id');
            $table->foreign('real_estate_id')->references('id')
                ->on('real_estates')->onDelete('cascade');

            $table->unsignedInteger('advertising_partner_id');
            $table->foreign('advertising_partner_id')->references('id')
                ->on('advertising_partners')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estates_advertising_partners');
    }
}
