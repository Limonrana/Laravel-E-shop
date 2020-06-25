<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('payment_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('method_order_id')->nullable();
            $table->string('order_amount')->nullable();
            $table->string('shipping')->nullable();
            $table->string('ship_name')->nullable();
            $table->string('ship_email')->nullable();
            $table->string('ship_phone')->nullable();
            $table->string('ship_address')->nullable();
            $table->string('ship_address_2')->nullable();
            $table->string('ship_city')->nullable();
            $table->string('ship_state')->nullable();
            $table->string('ship_zip')->nullable();
            $table->string('ship_country')->nullable();
            $table->string('status')->nullable();
            $table->integer('refund')->default(0);
            $table->string('tracking_number')->nullable();
            $table->string('month')->nullable();
            $table->string('date')->nullable();
            $table->string('year')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
