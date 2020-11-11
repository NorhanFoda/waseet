<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.s
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('msg_ar')->nullable();
            $table->text('msg_en')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->boolean('read')->default(0); // default is unread
            $table->string('type')->nullable()->default('admin-message');
            $table->unsignedBigInteger('extra_data')->nullable()->index();
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
        Schema::dropIfExists('notifications');
    }
}
