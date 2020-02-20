<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFabricFabricAttributeValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabric_fabric_attribute_value', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fabric_id')->unsigned();
            $table->foreign('fabric_id')->references('id')->on('fabrics');
            
            $table->bigInteger('fabric_attribute_value_id')->unsigned();
            $table->foreign('fabric_attribute_value_id')->references('id')->on('fabric_attribute_values');
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
        Schema::dropIfExists('fabric_fabric_attribute_value');
    }
}
