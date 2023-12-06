<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyClientToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->dropForeign('routes_presenter_id_foreign');
            $table->dropForeign('routes_created_by_id_foreign');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('presenter_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->dropForeign('routes_user_id_foreign');
            $table->dropForeign('routes_created_by_id_foreign');
            $table->dropColumn('user_id');

            $table->foreign('presenter_id')->references('id')->on('clients')->onDelete('set null');
            $table->foreign('created_by_id')->references('id')->on('clients')->onDelete('set null');
        });
    }
}
