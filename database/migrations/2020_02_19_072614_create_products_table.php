<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->string('session_id')->nullable();
            $table->string('name')->unique()->nullable();
            $table->string('slug')->unique()->nullable();
            $table->bigInteger('product_category_id')->nullable();
            $table->bigInteger('fabric_id')->nullable();
            $table->text('description')->nullable();
            $table->text('summary')->nullable();
            $table->decimal('price',9,2)->nullable();
            $table->decimal('og_price',9,2)->nullable();
            $table->string('p_image')->nullable();
            $table->string('s_image')->nullable();
            $table->text('album')->nullable();
            $table->text('metatag');
            $table->text('metadescp');
            $table->text('video')->nullable();
            $table->boolean('featured')->default(0);
            $table->boolean('menu')->default(0);
            $table->bigInteger('status_id')->default(1)->nullable();
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
        Schema::dropIfExists('products');
    }
}
