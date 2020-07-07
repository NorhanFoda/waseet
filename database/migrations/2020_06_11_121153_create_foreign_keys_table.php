<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('stage_id')->references('id')->on('stages')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('edu_level_id')->references('id')->on('edu_levels')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('edu_type_id')->references('id')->on('edu_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('nationality_id')->references('id')->on('nationalities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('bags', function(Blueprint $table) {
            $table->foreign('bag_category_id')->references('id')->on('bag_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('job_user', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('job_id')->references('id')->on('jobs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('ratings', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('saves', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('material_stage', function(Blueprint $table) {
            $table->foreign('material_id')->references('id')->on('materials')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->foreign('stage_id')->references('id')->on('stages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('material_user', function(Blueprint $table) {
            $table->foreign('material_id')->references('id')->on('materials')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('city_job', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('job_id')->references('id')->on('jobs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('bag_contents', function(Blueprint $table){
            $table->foreign('bag_id')->references('id')->on('bags')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('jobs', function(Blueprint $table){
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('organization_seeker', function(Blueprint $table){
            $table->foreign('org_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('seeker_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('addresses', function(Blueprint $table){
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_keys');
    }
}
