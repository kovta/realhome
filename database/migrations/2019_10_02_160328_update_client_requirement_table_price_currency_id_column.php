<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClientRequirementTablePriceCurrencyIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_requirements', function (Blueprint $table) {
            $table->unsignedInteger('price_currency_id')->nullable()->change();
            $table->foreign('price_currency_id')->references('id')->on('currencies');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('real_estates', function (Blueprint $table) {
            $table->dropForeign('price_currency_id');
            $table->unsignedInteger('price_currency_id')->change();
        });
    }
}
