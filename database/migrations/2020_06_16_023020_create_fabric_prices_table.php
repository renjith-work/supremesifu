<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFabricPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabric_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fabric_id');
            $table->bigInteger('product_attribute_set_id');
            $table->decimal('price', 20, 2);
            $table->decimal('splPrice', 20, 2)->nullable();
            $table->decimal('weight', 20, 2);
            $table->bigInteger('inventory_unit_id')->nullable();
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
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
        Schema::dropIfExists('fabric_prices');
    }
}
