<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Room_Links', function (Blueprint $table) {
            $table->increments('room_link_id');
            $table->unsignedInteger('room_id')->nullable();
            $table->unsignedInteger('room_nightmare_id')->nullable();
            $table->unsignedInteger('link_id')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=dream, 1=calm');
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
        Schema::dropIfExists('Rooms_Links');
    }
}
