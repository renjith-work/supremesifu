<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('managable')->nullable()->default(1);
            $table->decimal('quantity', 12, 4);
            $table->bigInteger('unit_id')->unsigned()->nullable();
            $table->decimal('threshold', 12, 4);
            $table->decimal('minimum_quantity', 12, 4);
            $table->decimal('maximum_quantity', 12, 4);
            $table->decimal('notification_quantity', 12, 4);
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
        Schema::dropIfExists('inventories');
    }
}
