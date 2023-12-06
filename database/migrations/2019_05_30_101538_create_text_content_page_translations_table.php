<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextContentPageTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_content_page_translations', function (Blueprint $table) {
            $table->increments('id');
            // FK
            $table->unsignedInteger('text_content_page_id')->nullable();
            $table->string('locale', 3)->index();
            $table->string('title', 200)->nullable();
            $table->text('content')->nullable();

            $table->unique(['id','locale']);
            $table->foreign('text_content_page_id')->references('id')->on('text_content_pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text_content_page_translations');
    }
}
