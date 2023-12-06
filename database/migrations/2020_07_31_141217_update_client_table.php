<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['type_enum', 'partner', 'client_id', 'contact_name', 'contact_email', 'contact_phone_1', 'contact_phone_2']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->smallInteger('type_enum')->default(2);
            $table->integer('client_id')->default(0);
            $table->string('contact_name', 200)->nullable();
            $table->string('contact_email', 200)->nullable();
            $table->string('contact_phone_1', 30)->nullable();
            $table->string('contact_phone_2', 30)->nullable();
            $table->string('partner', 200)->nullable();
        });
    }
}
