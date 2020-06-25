<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->bigInteger('subcategory_id')->nullable();
            $table->bigInteger('brand_id')->nullable();
            $table->string('product_name');
            $table->string('product_code')->nullable();
            $table->string('slug');
            $table->string('product_quantity');
            $table->text('short_description');
            $table->text('product_description')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_capacity')->nullable();
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->string('video_link')->nullable();
            $table->integer('header_slider')->nullable();
            $table->integer('hot_deal')->nullable();
            $table->integer('best_rated')->nullable();
            $table->integer('mid_slider')->nullable();
            $table->integer('hot_new')->nullable();
            $table->integer('trend')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('gallery_image_1')->nullable();
            $table->string('gallery_image_2')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('products');
    }
}
