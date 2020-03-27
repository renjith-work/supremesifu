<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasureProfileProductAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measure_profile_product_attribute_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mp_id')->nullable();
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
        Schema::dropIfExists('measure_profile_product_attribute_values');
    }
}
