<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceToTariffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_to_tariff', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tariff_id')->unsigned();
            $table->integer('service_id')->unsigned();

            $table->foreign('tariff_id')->references('id')->on('tariffs');
            $table->foreign('service_id')->references('id')->on('tariff_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('service_to_tariff');
    }
}
