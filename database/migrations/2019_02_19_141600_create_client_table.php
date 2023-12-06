<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->smallInteger('type_enum')->default(2);
            $table->unsignedInteger('user_id');

            $table->integer('client_id')->default(0);
            $table->smallInteger('status_enum')->default(2);
            $table->string('phone_1', 30)->nullable();
            $table->string('phone_2', 30)->nullable();
            $table->smallInteger('preferred_contact_enum')->nullable();
            $table->string('contact_name', 200)->nullable();
            $table->string('contact_email', 200)->nullable();
            $table->string('contact_phone_1', 30)->nullable();
            $table->string('contact_phone_2', 30)->nullable();
            $table->string('partner', 200)->nullable();
            $table->smallInteger('source_enum')->nullable();
            $table->unsignedInteger('broker_id')->nullable();
            $table->date('last_contacted')->nullable();
            $table->string('nationality', 50)->nullable();
            $table->smallInteger('number_tenants')->nullable();
            $table->smallInteger('number_children')->nullable();
            $table->string('children_age', 200)->nullable();
            $table->smallInteger('required_school_enum')->nullable();
            $table->string('pet', 50)->nullable();
            $table->date('moveindate')->nullable();
            $table->text('comment')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('broker_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
