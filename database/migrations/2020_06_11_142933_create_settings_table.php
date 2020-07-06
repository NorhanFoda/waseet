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

            $table->string('welcome_text_ar');
            $table->string('welcome_text_en');

            $table->string('header_logo');

            $table->text('text_before_add_ar');
            $table->text('text_before_add_en');

            $table->text('text_after_add_ar');
            $table->text('text_after_add_en');

            $table->string('text_after_add_image');

            $table->string('section_1_title_ar');
            $table->string('section_1_title_en');

            $table->text('section_1_text_ar');
            $table->text('section_1_text_en');

            $table->string('section_2_title_ar');
            $table->string('section_2_title_en');

            $table->text('section_2_text_ar');
            $table->text('section_2_text_en');

            $table->string('section_3_title_ar');
            $table->string('section_3_title_en');

            $table->text('section_3_text_ar');
            $table->text('section_3_text_en');

            $table->text('footer_text_ar');
            $table->text('footer_text_en');

            $table->string('footer_logo');

            $table->string('contact_us_title_ar');
            $table->string('contact_us_title_en');

            $table->text('contact_us_text_ar');
            $table->text('contact_us_text_en');

            $table->string('saved_title_ar');
            $table->string('saved_title_en');

            $table->text('saved_text_ar');
            $table->text('saved_text_en');

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
