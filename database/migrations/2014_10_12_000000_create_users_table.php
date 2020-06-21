<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable()->unique();
            $table->unsignedBigInteger('country_id')->nullable()->index();
            $table->unsignedBigInteger('city_id')->nullable()->index();
            $table->unsignedBigInteger('stage_id')->nullable()->index();
            $table->string('address')->nullable();
            $table->integer('exper_years')->nullable();
            $table->string('salary_month')->nullable();
            $table->string('salary_hour')->nullable();
            $table->integer('age')->nullable();
            $table->string('edu_level')->nullable();
            // $table->integer('no_of_students')->nullable();
            // $table->text('breif_ar')->nullable();
            // $table->text('breif_en')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
