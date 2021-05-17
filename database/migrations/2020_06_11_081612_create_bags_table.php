<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->text('description_ar');
            $table->text('description_en');
            $table->string('price');
            $table->text('contents_ar');
            $table->text('contents_en');
            $table->text('benefits_ar');
            $table->text('benefits_en');
            $table->string('video')->nullable();
            $table->string('poster')->nullable();
            $table->unsignedBigInteger('bag_category_id')->nullable()->index(); // bags category id
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
        Schema::dropIfExists('bags');
    }
}
