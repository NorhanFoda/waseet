<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('short_description_ar');
            $table->string('short_description_en');

            $table->text('vision_ar')->nullable();
            $table->text('vision_en')->nullable();
            $table->text('message_ar')->nullable();
            $table->text('message_en')->nullable();

            $table->text('full_description_ar');
            $table->text('full_description_en');
            $table->boolean('appear_in_footer');
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
        Schema::dropIfExists('static_pages');
    }
}
