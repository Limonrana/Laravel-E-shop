<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
//            $table->string('logo');
//            $table->string('favicon');
//            $table->string('site_title');
//            $table->string('site_description');
//            $table->string('call_us_text');
//            $table->string('footer_description');
//            $table->string('phone');
//            $table->string('email');
            $table->string('admin_email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
