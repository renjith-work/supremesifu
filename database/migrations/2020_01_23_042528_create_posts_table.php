<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->text('bodyE')->nullable();
            $table->text('bodyH')->nullable();
            $table->string('image');
            $table->string('album')->nullable();
            $table->text('video')->nullable();
            $table->bigInteger('status_id')->unsigned()->nullable()->default(1);
            $table->boolean('featured')->default(0);
            $table->bigInteger('design_id')->unsigned()->nullable()->default(1);
            $table->text('metatag');
            $table->text('metadescp');
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
        Schema::dropIfExists('posts');
    }
}
