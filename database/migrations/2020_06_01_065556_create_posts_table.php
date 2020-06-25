<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_title_en');
            $table->string('post_title_bn')->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('tag_name')->nullable();
            $table->string('slug');
            $table->text('post_description_en');
            $table->text('post_description_bn')->nullable();
            $table->string('video_link')->nullable();
            $table->string('featured_image');
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
        Schema::dropIfExists('posts');
    }
}
