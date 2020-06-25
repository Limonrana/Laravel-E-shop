<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderFootersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_footers', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('logo_width')->nullable();
            $table->string('menu_image')->nullable();
            $table->string('top_massage')->nullable();
            $table->string('phone_subtitle')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('footer_title')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_footer')->nullable();
            $table->string('email_footer')->nullable();
            $table->string('working_day')->nullable();
            $table->string('newsletter_title')->nullable();
            $table->string('newsletter_subtitle')->nullable();
            $table->string('copyright_text')->nullable();
            $table->string('payment_logo')->nullable();
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
        Schema::dropIfExists('header_footers');
    }
}
