<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_designs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique()->nullable();
            $table->string('slug')->unique()->nullable();
            $table->bigInteger('product_attribute_set_id')->nullable();
            $table->bigInteger('fabric_id')->nullable();
            $table->text('description')->nullable();
            $table->text('summary')->nullable();
            $table->bigInteger('tax_class_id')->nullable();
            $table->string('pageTitle');
            $table->text('metatag');
            $table->text('metadescp');
            $table->boolean('featured')->default(0);
            $table->boolean('menu')->default(0);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('product_designs');
    }
}
