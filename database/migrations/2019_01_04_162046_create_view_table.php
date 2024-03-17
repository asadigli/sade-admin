<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->default(0);
            $table->integer('cat_id')->default(0);
            $table->integer('subcat_id')->default(0);
            $table->integer('news_id')->default(0);
            $table->integer('page_id')->default(0);
            $table->string('user_ip')->default("0.0.0.0");
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
        Schema::dropIfExists('view');
    }
}
