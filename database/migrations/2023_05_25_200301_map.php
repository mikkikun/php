<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Map extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('場所名');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('comment',255);
            $table->geometry('location')->comment('緯度・経度');
            $table->timestamps();
            $table->spatialIndex('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('map');
    }
}
