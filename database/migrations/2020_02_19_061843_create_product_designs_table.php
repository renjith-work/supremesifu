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
            $table->bigInteger('product_category_id')->nullable();
            $table->bigInteger('fabric_id')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('price',9,2)->nullable();
            $table->decimal('og_price',9,2)->nullable();
            $table->text('description');
            $table->text('summary');
            $table->string('p_image');
            $table->string('s_image');
            $table->text('album');
            $table->string('folder');
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
        Schema::dropIfExists('product_designs');
    }
}
