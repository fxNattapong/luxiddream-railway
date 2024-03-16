<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersStats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Player_Stats', function (Blueprint $table) {
            $table->increments('player_stats_id');
            $table->unsignedInteger('player_id')->nullable();
            $table->integer('played_all')->nullable();
            $table->datetime('played_last')->nullable();
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
        Schema::dropIfExists('Players_Stats');
    }
}
