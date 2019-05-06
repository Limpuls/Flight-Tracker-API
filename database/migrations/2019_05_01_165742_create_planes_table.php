<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    /*Schema::table('posts', function (Blueprint $table) {
    $table->unsignedBigInteger('user_id');

    $table->foreign('user_id')->references('id')->on('users');
    });*/
    public function up()
    {
        Schema::create('manufacturer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            /*$table->string('model');
            $table->date('built');*/
            $table->timestamps();
        });

        Schema::create('planes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('icao24');
            $table->bigInteger('manufacturer_id')->unsigned()->nullable();
            $table->foreign('manufacturer_id')->references('id')->on('manufacturer');
            //$table->date('registration');
            $table->timestamps();
        });


        /*Schema::create('owner', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plane_id');
            $table->foreign('plane_id')->references('id')->on('planes')->nullable();
            $table->string('name');
            $table->date('reg_until');
            $table->timestamps();
        });*/

        Schema::create('engine', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
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
        Schema::dropIfExists('planes');
    }
}
