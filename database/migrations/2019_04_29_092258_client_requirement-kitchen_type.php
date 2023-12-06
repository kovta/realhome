<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientRequirementKitchenType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_requirement_kitchen_types', function(Blueprint $table){
            $table->unsignedInteger('client_requirement_id');
            $table->foreign('client_requirement_id')->references('id')
                ->on('client_requirements')->onDelete('cascade');

            $table->unsignedInteger('kitchen_type_enum');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_requirement_kitchen_types');
    }
}
