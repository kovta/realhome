<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnToRealEstateTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('real_estate_types', function (Blueprint $table) {
            $table->boolean('real_estate_offer_pdf_green_box')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('real_estate_types', function (Blueprint $table) {
            $table->dropColumn('real_estate_offer_pdf_green_box');
        });
    }
}
