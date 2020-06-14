<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('welcome_text');
            $table->string('header_logo');
            $table->string('text_before_add');
            $table->string('text_after_add');
            $table->string('text_after_add_image');
            $table->string('sestion_1_title');
            $table->string('sestion_1_text');
            $table->string('sestion_2_title');
            $table->string('sestion_2_text');
            $table->string('sestion_3_title');
            $table->string('sestion_3_text');
            $table->string('footer_text');
            $table->string('footer_logo');
            $table->string('contact_us_title');
            $table->string('contact_us_text');
            $table->string('saved_title');
            $table->string('saved_text');
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
        Schema::dropIfExists('settings');
    }
}
