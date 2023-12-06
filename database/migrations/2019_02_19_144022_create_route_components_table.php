<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_components', function (Blueprint $table) {
            $table->increments('id');
            // FK
            $table->unsignedInteger('route_id');
            $table->smallInteger('position')->default(0);
            // FK
            $table->unsignedInteger('real_estate_id')->nullable();
            $table->string('visit_time', 200)->nullable();
            $table->text('comment')->nullable();

            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
            $table->foreign('real_estate_id')->references('id')->on('real_estates')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_components');
    }
}
