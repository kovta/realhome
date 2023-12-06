<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('partner_name')->nullable();
            $table->smallInteger('preferred_contact_enum')->nullable();
            $table->string('contact_name', 200)->nullable();
            $table->string('contact_email', 191)->nullable();
            $table->string('contact_phone_1', 30)->nullable();
            $table->string('contact_phone_2', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partners');
    }
}
