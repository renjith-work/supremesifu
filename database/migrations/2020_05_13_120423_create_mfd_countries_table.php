<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMfdCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mfd_countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('iso_code2')->unique();
            $table->string('iso_code3')->unique();
            $table->string('numeric')->unique();
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
        Schema::dropIfExists('mfd_countries');
    }
}
