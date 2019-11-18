<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCournotGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cournot_games', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('hashed_link');

            $table->integer('number_of_turns');
            $table->json('number_of_players');

            $table->json('game_urls');

            $table->json('plays');

            $table->json('payoffs');

            $table->boolean('isFinished')->default(false);

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
        Schema::dropIfExists('cournot_games');
    }
}
