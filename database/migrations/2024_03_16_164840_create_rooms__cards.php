<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Room_Cards', function (Blueprint $table) {
            $table->increments('room_card_id');
            $table->unsignedInteger('room_link_id')->nullable();
            $table->string('code', 10)->nullable();
            $table->tinyInteger('position')->nullable()->comment('0=first, 1=second, 2=third, 3=fourth');
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
        Schema::dropIfExists('Rooms_Cards');
    }
}
