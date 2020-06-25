<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('posts')->nullable();
            $table->unsignedBigInteger('pages')->nullable();
            $table->unsignedBigInteger('comments')->nullable();
            $table->unsignedBigInteger('reviews')->nullable();
            $table->unsignedBigInteger('coupons')->nullable();
            $table->unsignedBigInteger('ecommerce')->nullable();
            $table->unsignedBigInteger('orders')->nullable();
            $table->unsignedBigInteger('products')->nullable();
            $table->unsignedBigInteger('stock_manage')->nullable();
            $table->unsignedBigInteger('theme_panel')->nullable();
            $table->unsignedBigInteger('mail')->nullable();
            $table->unsignedBigInteger('widgets')->nullable();
            $table->unsignedBigInteger('users')->nullable();
            $table->unsignedBigInteger('tools')->nullable();
            $table->unsignedBigInteger('settings')->nullable();
            $table->unsignedBigInteger('create_admin')->nullable();
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
        Schema::dropIfExists('roles');
    }
}
