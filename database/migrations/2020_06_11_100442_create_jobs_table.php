<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->integer('work_hours');
            $table->integer('exper_years');
            // $table->string('address');
            $table->integer('required_number');
            $table->integer('free_places');
            $table->text('description_ar');
            $table->text('description_en');
            $table->integer('required_age');
            $table->string('salary');
            $table->boolean('approved')->default(0);
            
            // $table->unsignedBigInteger('country_id')->nullable()->index();
            // $table->unsignedBigInteger('city_id')->nullable()->index();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();

            $table->unsignedBigInteger('specialization_id')->nullable()->index();
            $table->string('other_specialization')->nullable();

            $table->unsignedBigInteger('user_id')->nullable()->index();
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
        Schema::dropIfExists('jobs');
    }
}
