<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cards', function (Blueprint $table) {
            $table->increments('card_id');
            $table->string('code', 10)->nullable();
            $table->tinyInteger('skill')->nullable()->comment('0=search, 1=listening, 2=link');
            $table->tinyInteger('color')->nullable()->comment('0=red, 1=yellow, 2=green, 3=blue');
            $table->string('name', 100)->nullable();
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
        Schema::dropIfExists('Cards');
    }
}
