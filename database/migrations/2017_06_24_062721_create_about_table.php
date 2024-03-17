<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('about');
            $table->string('title2');
            $table->text('about2');
            $table->string('title3');
            $table->text('about3');
            $table->string('title4');
            $table->text('about4');
            $table->string('title5');
            $table->text('about5');
            $table->string('title6');
            $table->text('about6');
            $table->string('title7');
            $table->text('about7');
            $table->string('title8');
            $table->text('about8');
            $table->string('title9');
            $table->text('about9');
            $table->string('title10');
            $table->text('about10');
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
        Schema::dropIfExists('about');
    }
}
