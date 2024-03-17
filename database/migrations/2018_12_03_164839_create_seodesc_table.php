<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeodescTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seodesc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->default(0);
            $table->integer('category_id')->default(0);
            $table->integer('subcategory_id')->default(0);
            $table->integer('news_id')->default(0);
            $table->integer('page_id')->default(0);
            $table->text('description');
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
        Schema::dropIfExists('seodesc');
    }
}
