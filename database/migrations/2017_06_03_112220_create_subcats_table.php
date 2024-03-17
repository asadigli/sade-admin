<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('parent_id')->unsigned();
            $table->string('name');
            $table->timestamps();
        });
        Schema::table('subcat', function($table) {
          $table->foreign('parent_id')->references('id')->on('category');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcat');
    }
}
