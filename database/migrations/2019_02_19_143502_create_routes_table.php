<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->increments('id');
            // FK
            $table->unsignedInteger('offer_id')->nullable();
            // FK
            $table->unsignedInteger('client_id')->nullable();
            $table->date('date')->nullable();
            $table->string('meeting_location', 200)->nullable();
            //FK
            $table->unsignedInteger('presenter_id')->nullable();
            $table->text('comment')->nullable();
            //FK
            $table->unsignedInteger('created_by_id')->nullable();
            $table->timestamps();

            $table->foreign('offer_id')->references('id')->on('real_estate_offers')->onDelete('set null');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->foreign('presenter_id')->references('id')->on('clients')->onDelete('set null');
            $table->foreign('created_by_id')->references('id')->on('clients')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
