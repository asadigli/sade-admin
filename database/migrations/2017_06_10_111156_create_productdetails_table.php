<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productdetails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('subcat_id')->unsigned();
            $table->integer('confirmed')->default('0');
            $table->string('productname')->unique();
            $table->integer('price');
            $table->string('currency');
            $table->string('quantity');
            $table->string('photos')->default('defaultimage.jpg');
            $table->string('photos2')->nullable();
            $table->string('photos3')->nullable();
            $table->string('photos4')->nullable();
            $table->string('photos5')->nullable();
            $table->string('photos6')->nullable();
            $table->string('photos7')->nullable();
            $table->string('brand')->nullable();
            $table->date('releasedate')->nullable();
            $table->string('dimension')->nullable();
            $table->string('contact')->nullable();
            $table->string('videolink')->nullable();
            $table->string('discount')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('phonecode')->nullable();
            $table->string('features');
            $table->integer('condition');
            $table->string('descriptionname')->nullable();
            $table->text('description')->nullable();
            $table->string('descriptionname2')->nullable();
            $table->text('description2')->nullable();
            $table->timestamps();
        });
      Schema::table('productdetails', function($table) {
          $table->foreign('seller')->references('id')->on('users');
          $table->foreign('category_id')->references('id')->on('category');
          $table->foreign('subcat_id')->references('id')->on('subcat');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productdetails');
    }
}
