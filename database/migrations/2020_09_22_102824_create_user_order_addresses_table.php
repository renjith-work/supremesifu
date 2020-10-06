<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_order_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->unsignedInteger('phone_code_id');
            $table->string('phone');
            $table->unsignedInteger('zone_id');
            $table->string('city');
            $table->unsignedInteger('country_id');
            $table->string('postcode');
            $table->text('address');
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
        Schema::dropIfExists('user_order_addresses');
    }
}
