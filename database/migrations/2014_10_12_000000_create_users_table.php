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
            $table->string('phone_main')->unique();
            $table->string('phone_secondary')->nullable();
            $table->unsignedBigInteger('country_id')->nullable()->index();
            $table->unsignedBigInteger('city_id')->nullable()->index();
            $table->unsignedBigInteger('stage_id')->nullable()->index();
            $table->string('address')->nullable();
            $table->integer('exper_years')->nullable();
            $table->string('salary_month')->nullable();
            $table->string('salary_hour')->nullable();
            $table->integer('age')->nullable();
            $table->unsignedBigInteger('edu_level_id')->nullable()->index();
            $table->unsignedBigInteger('edu_type_id')->nullable()->index();
            $table->boolean('organizayion_gender')->default(1); // 0 -> sons - 1 -> girls
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
