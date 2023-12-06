<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealEstateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_translations', function (Blueprint $table) {
            $table->increments('id');
            // FK
            $table->unsignedInteger('real_estate_id')->nullable();
            $table->string('locale', 3)->index();
            $table->string('marketing_name', 200)->nullable();
            $table->text('description')->nullable();

            $table->unique(['id','locale']);
            $table->foreign('real_estate_id')->references('id')->on('real_estates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estate_translations');
    }
}
