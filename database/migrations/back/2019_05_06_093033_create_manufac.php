<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManufac extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//$table->bigInteger('manufacturer_name')->unsigned()->default(1);
//            $table->foreign('manufacturer_name')->references('name')->on('manufacturer');

            Schema::create('manufacturer', function (Blueprint $table) {
                $table->bigIncrements('id')->autoIncrement();
                //$table->string('manufacturer_name');
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
        Schema::dropIfExists('manufac');
    }
}
