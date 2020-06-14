<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->time('time');
            $table->string('day_duration');
            $table->string('student_name');
            $table->date('birth_date'); // هنشيلها ة نحط مكان المرحله التعليميه و الماده العلميه
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('address');
            $table->unsignedBigInteger('user_id')->nullable()->index(); // teacher id
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
        Schema::dropIfExists('reservations');
    }
}
