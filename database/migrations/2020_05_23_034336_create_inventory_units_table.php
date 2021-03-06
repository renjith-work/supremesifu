<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('abbrevation')->unique();
            $table->bigInteger('type_id')->unsigned()->nullable();
            $table->text('description');
            $table->boolean('status')->nullable()->default(1);
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
        Schema::dropIfExists('inventory_units');
    }
}
