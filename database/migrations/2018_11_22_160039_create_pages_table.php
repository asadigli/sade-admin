<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('details');
            $table->string('token');
            $table->string('image')->default('default.jpg');
            $table->integer('footer_seem')->default(0);
            $table->integer('header_seem')->default(0);
            $table->integer('temp')->default(0);
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            //0 should be not active and 1 is active
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('pages');
    }
}
