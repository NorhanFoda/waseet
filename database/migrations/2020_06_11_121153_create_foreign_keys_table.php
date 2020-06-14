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

            $table->foreign('stage_id')->references('id')->on('stages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('reservations', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('bags', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('bag_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('videos', function(Blueprint $table) {
            $table->foreign('bag_id')->references('id')->on('bags')
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

        Schema::table('documents', function(Blueprint $table) {
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
