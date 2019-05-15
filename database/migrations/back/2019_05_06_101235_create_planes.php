<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
        $table->bigIncrements('id')->autoIncrement();
        $table->string('icao24');
        $table->bigInteger('manufacturer_name')->unsigned()->default(1);
        $table->foreign('manufacturer_name')->references('id')->on('manufacturer');
        //$table->date('registration');
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
