<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DelColumnsInSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('socials', function ($table) {
            $table->dropColumn(['vk_name', 'ok_name', 'fb_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('socials', function ($table) {
            $table->string('vk_name', 80);
            $table->string('ok_name', 80);
            $table->string('fb_name', 80);
        });
    }
}
