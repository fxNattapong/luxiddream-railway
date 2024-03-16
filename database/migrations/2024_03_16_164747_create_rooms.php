<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Rooms', function (Blueprint $table) {
            $table->increments('room_id');
            $table->unsignedInteger('player_rule_id')->nullable();
            $table->unsignedInteger('level_id')->nullable();
            $table->string('invite_code', 30)->nullable();
            $table->string('creator_name', 50)->nullable();
            $table->tinyInteger('round')->default(0)->nullable();
            $table->tinyInteger('circle')->nullable();
            $table->datetime('time')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=playing, 1=good end, 2=bad end');
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
        Schema::dropIfExists('Rooms');
    }
}
