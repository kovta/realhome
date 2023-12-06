<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSmallPetAllowedToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_requirements', function (Blueprint $table) {
            $table->tinyInteger('small_pet_allowed')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_requirements', function (Blueprint $table) {
            $table->dropColumn('small_pet_allowed');
        });
    }
}
