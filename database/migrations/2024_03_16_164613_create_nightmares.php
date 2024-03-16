<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNightmares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Nightmares', function (Blueprint $table) {
            $table->increments('nightmare_id');
            $table->tinyInteger('type')->nullable()->comment('0=anger, 1=anxiety, 2=panic, 3=sad, 4=peace, 5=start');
            $table->string('description', 100)->nullable();
            $table->string('image', 255)->nullable();
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
        Schema::dropIfExists('Nightmares');
    }
}
