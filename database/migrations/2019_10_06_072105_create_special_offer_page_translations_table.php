<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialOfferPageTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_offer_page_translations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('special_offer_page_id')->nullable();
            $table->string('locale', 3)->index();
            $table->string('menu_name', 50);
            $table->text('page_text', 50)->nullable();

            $table->unique(['id','locale']);
            $table->foreign('special_offer_page_id')->references('id')->on('special_offer_pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_offer_page_translations');
    }
}
