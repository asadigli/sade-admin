<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poster', function (Blueprint $table) {
            $table->increments('id');
            $table->string('poster');
            $table->integer('product_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->string('time');
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
        Schema::dropIfExists('poster');
    }
}
