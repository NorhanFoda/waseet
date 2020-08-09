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
            // $table->string('email')->unique();
            $table->string('email');
            $table->string('phone_main')->nullable()->unique();
            $table->string('password');
            $table->boolean('is_verified')->default(0);
            $table->boolean('allow_notification')->default(1);
            $table->string('api_token', 191)->unique()->nullable();
            $table->date('api_token_create_date')->nullable();
            $table->date('api_token_expire_date')->nullable();
            $table->string('phone_secondary')->nullable();
            $table->string('code')->nullable();
            $table->unsignedBigInteger('country_id')->nullable()->index();
            $table->unsignedBigInteger('city_id')->nullable()->index();
            $table->unsignedBigInteger('stage_id')->nullable()->index();
            $table->unsignedBigInteger('nationality_id')->nullable()->index();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('address')->nullable();
            $table->string('teaching_lat')->nullable();
            $table->string('teaching_long')->nullable();
            $table->string('teaching_address')->nullable();
            $table->integer('exper_years')->nullable();
            $table->string('salary_month')->nullable();
            $table->string('salary_hour')->nullable();
            $table->integer('age')->nullable();
            $table->text('bio_ar')->nullable();
            $table->text('bio_en')->nullable();
            $table->unsignedBigInteger('edu_level_id')->nullable()->index();
            $table->string('other_edu_level')->nullable();
            $table->unsignedBigInteger('edu_type_id')->nullable()->index();
            $table->string('other_edu_type')->nullable();
            $table->boolean('organizayion_gender')->default(1); // 0 -> sons - 1 -> girls
            $table->timestamp('email_verified_at')->nullable();
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
