<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpdeskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helpdesk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('problem_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_email')->nullable();
            $table->integer('reply_user_id')->nullable();
            $table->integer('reply_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->string('problem_title');
            $table->text('problem_body');
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
        Schema::dropIfExists('helpdesk');
    }
}
