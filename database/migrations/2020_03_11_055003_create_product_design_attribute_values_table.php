<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDesignAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_design_attribute_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_design_id')->nullable();
            $table->bigInteger('product_attribute_id')->nullable();
            $table->bigInteger('product_attribute_value_id')->nullable();
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
        Schema::dropIfExists('product_design_attribute_values');
    }
}
