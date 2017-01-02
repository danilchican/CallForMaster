<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTariffsPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariff_prices', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tariff_id')->unsigned();
            $table->decimal('price', 8, 6);
            $table->string('range');

            $table->foreign('tariff_id')->references('id')->on('tariffs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tariff_prices');
    }
}
