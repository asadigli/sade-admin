<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoostedproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boostedproducts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->string('product_currency')->nullable();
            $table->string('productname');
            $table->text('product_features');
            $table->string('product_price');
            $table->integer('product_seller');
            $table->string('boost_period');
            $table->string('product_discount')->nullable();
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
        Schema::dropIfExists('boostedproducts');
    }
}
