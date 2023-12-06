<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('real_estate_routes_temporary_url', static function (Blueprint $table) {
            $table->increments('id');
            $table->integer('route_id');
            $table->char('unique_id');
            $table->boolean('pdf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estate_routes_temporary_url');
    }
};
