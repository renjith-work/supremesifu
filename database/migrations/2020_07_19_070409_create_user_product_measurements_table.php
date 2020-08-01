<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProductMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_product_measurements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ump_id')->nullable(); 
            $table->bigInteger('product_id')->nullable(); 
            $table->bigInteger('m_at_id')->nullable(); //User measurement profile attribute ID
            $table->decimal('value', 9, 2);
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
        Schema::dropIfExists('user_product_measurements');
    }
}
