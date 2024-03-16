<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Levels', function (Blueprint $table) {
            $table->increments('level_id');
            $table->tinyInteger('level')->nullable()->comment('0=easy, 1=medium, 2=hard');
            $table->tinyInteger('round')->nullable();
            $table->string('time_1', 5)->nullable();
            $table->string('time_2', 5)->nullable();
            $table->string('time_3', 5)->nullable();
            $table->string('time_4', 5)->nullable();
            $table->string('time_5', 5)->nullable();
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
        Schema::dropIfExists('Levels');
    }
}
