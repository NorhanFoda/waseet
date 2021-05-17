<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->float('total_price'); // total price of order without shipping fees
            $table->unsignedBigInteger('address_id')->nullable()->index();
            $table->integer('status'); // 1 -> not confirmed / 2 -> waiting / 3 -> shipping / 4 -> delivered
            $table->float('shipping_fees');
            $table->unsignedBigInteger('payment_method_id')->nullable()->index();
            $table->enum('buy_type', [1,2])->nullable();  // 1 -> onlinebuy, 2 -> printcontent
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
        Schema::dropIfExists('orders');
    }
}
