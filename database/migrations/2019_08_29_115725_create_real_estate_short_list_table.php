<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealEstateShortListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_short_list', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('real_estate_id');
            $table->unsignedInteger('client_id');

            $table->foreign('real_estate_id')->references('id')->on('real_estates')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estate_short_list');
    }
}
