<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasurementAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurement_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->enum('frontend_type', ['select', 'radio', 'text', 'text_area']);
            $table->bigInteger('measurement_category_id')->nullable();
            $table->bigInteger('product_category_id')->nullable();
            $table->bigInteger('tutorial_id')->nullable();
            $table->boolean('is_filterable')->default(0);
            $table->boolean('is_required')->default(0);
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
        Schema::dropIfExists('measurement_attributes');
    }
}
