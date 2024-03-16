<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsNightmares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Room_Nightmares', function (Blueprint $table) {
            $table->increments('room_nightmare_id');
            $table->unsignedInteger('room_id')->nullable();
            $table->unsignedInteger('room_link_id')->nullable();
            $table->unsignedInteger('nightmare_id')->nullable();
            $table->tinyInteger('circle')->nullable();
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
        Schema::dropIfExists('Rooms_Nightmares');
    }
}
