<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBagOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bag_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bag_id')->index();
            $table->unsignedBigInteger('order_id')->index();
            $table->float('total_price')->index(); // total price = single bag price * bag quantity
            $table->Integer('quantity')->index();
            $table->datetime('accepted')->nullable();
            $table->datetime('shipped')->nullable();
            $table->datetime('delivered')->nullable();
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
        Schema::dropIfExists('bag_order');
    }
}
