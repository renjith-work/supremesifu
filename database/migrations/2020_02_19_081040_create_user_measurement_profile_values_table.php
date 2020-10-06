<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMeasurementProfileValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_measurement_profile_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('u_mp_id')->nullable(); //User measurement Profile ID
            $table->bigInteger('m_at_id')->nullable(); //User measurement profile attribute ID
            $table->decimal('value', 20, 2);
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
        Schema::dropIfExists('user_measurement_profile_values');
    }
}
