<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToProductdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productdetails', function (Blueprint $table) {
            $table->string('main_id')->nullable();
            $table->string('shipping_in_baku')->nullable();
            $table->string('shipping_to_regions')->nullable();
            $table->string('sadestore_points')->nullable();
            $table->string('buy_2_get_1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productdetails', function (Blueprint $table) {
            //
        });
    }
}
