<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersRule extends Migration
{
    public function up()
    {
        Schema::create('Players_Rule', function (Blueprint $table) {
            $table->increments('player_rule_id');
            $table->unsignedSmallInteger('amount')->nullable();
            $table->unsignedSmallInteger('circle')->nullable();
            $table->unsignedSmallInteger('nightmare_5')->nullable();
            $table->unsignedSmallInteger('nightmare_6')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Players_Rule');
    }
}
