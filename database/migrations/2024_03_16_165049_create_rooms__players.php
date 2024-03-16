<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsPlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Room_Players', function (Blueprint $table) {
            $table->increments('room_player_id');
            $table->unsignedInteger('player_id')->nullable();
            $table->unsignedInteger('room_id')->nullable();
            $table->string('name_ingame', 50)->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=not ready, 1=ready, 2=dis, 3=playing, 4=end');
            $table->tinyInteger('role')->default(0)->comment('0=player, 1=creator');
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
        Schema::dropIfExists('Rooms_Players');
    }
}
