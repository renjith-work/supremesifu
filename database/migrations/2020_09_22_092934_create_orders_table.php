<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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

            $table->bigIncrements('id');
            $table->string('order_number')->unique();
            $table->unsignedInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            
            $table->unsignedInteger('order_status_id')->default(1);
            // $table->foreign('order_status_id')->references('id')->on('order_statuses');
            
            $table->unsignedInteger('order_payment_id');
            // $table->foreign('order_payment_id')->references('id')->on('order_payments');

            $table->unsignedInteger('item_count');

            $table->boolean('payment_status')->default(1);
            $table->string('payment_method')->nullable();

            $table->unsignedInteger('order_address_id');
            // $table->foreign('order_address_id')->references('id')->on('order_addresses');

            $table->text('notes')->nullable();

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
