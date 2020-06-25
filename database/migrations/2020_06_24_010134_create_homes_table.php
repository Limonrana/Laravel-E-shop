<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->string('left_banner_1')->nullable();
            $table->string('left_banner_2')->nullable();
            $table->string('left_banner_3')->nullable();
            $table->string('mid_banner_1')->nullable();
            $table->string('mid_banner_2')->nullable();
            $table->string('mid_banner_3')->nullable();
            $table->string('right_banner_1')->nullable();
            $table->string('right_banner_2')->nullable();
            $table->string('right_banner_3')->nullable();
            $table->string('info_title_1')->nullable();
            $table->string('info_title_2')->nullable();
            $table->string('info_title_3')->nullable();
            $table->string('info_subtitle_1')->nullable();
            $table->string('info_subtitle_2')->nullable();
            $table->string('info_subtitle_3')->nullable();
            $table->string('info_icon_1')->nullable();
            $table->string('info_icon_2')->nullable();
            $table->string('info_icon_3')->nullable();
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
        Schema::dropIfExists('homes');
    }
}
