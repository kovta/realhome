<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealEstateTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('real_estate_type_id')->nullable();
            $table->string('locale', 3)->index();
            $table->string('name', 50);

            $table->unique(['id','locale']);
            $table->foreign('real_estate_type_id')->references('id')->on('real_estate_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estate_type_translations');
    }
}
