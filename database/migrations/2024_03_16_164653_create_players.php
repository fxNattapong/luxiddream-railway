<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Players', function (Blueprint $table) {
            $table->increments('player_id');
            $table->string('username', 50)->nullable();
            $table->string('password', 50)->nullable();
            $table->string('phone', 10)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('image', 255)->nullable();
            $table->tinyInteger('role')->default(0)->comment('0=player, 1=admin');
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
        Schema::dropIfExists('Players');
    }
}
