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
            $table->float('total_price')->nullable(); // total price = single bag price * bag quantity
            $table->Integer('quantity')->nullable()->index();
            $table->datetime('accepted')->nullable();
            $table->datetime('shipped')->nullable();
            $table->datetime('delivered')->nullable();
            $table->integer('buy_type')->nullable();  // 1 -> onlinebuy, 2 -> printcontent
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
