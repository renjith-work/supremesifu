<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributeImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->bigInteger('height');
            $table->bigInteger('width');
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
        Schema::dropIfExists('product_attribute_images');
    }
}
