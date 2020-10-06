<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_attribute_id')->nullable();
            $table->string('value');
            $table->text('description');
            $table->decimal('price', 20, 2)->nullable();
            $table->string('d_image');
            $table->string('d_drawing');
            $table->string('c_image');
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
        Schema::dropIfExists('product_attribute_values');
    }
}
