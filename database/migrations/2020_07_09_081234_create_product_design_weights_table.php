<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDesignWeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_design_weights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_design_id')->nullable();
            $table->bigInteger('inventory_unit_id')->nullable();
            $table->decimal('weight', 20, 2);
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
        Schema::dropIfExists('product_design_weights');
    }
}
