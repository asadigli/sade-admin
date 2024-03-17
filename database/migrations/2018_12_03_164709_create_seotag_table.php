<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeotagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seotag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->default(0);
            $table->integer('category_id')->default(0);
            $table->integer('subcategory_id')->default(0);
            $table->integer('news_id')->default(0);
            $table->integer('page_id')->default(0);
            $table->string('tag');
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
        Schema::dropIfExists('seotag');
    }
}
