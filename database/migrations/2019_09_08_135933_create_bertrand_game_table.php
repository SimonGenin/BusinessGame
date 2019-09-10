<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBertrandGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bertrand_games', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('hashed_link');
            $table->integer('number_of_turns');
            $table->integer('number_of_players');
            $table->json('game_urls');
            $table->json('plays');

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
        Schema::dropIfExists('bertrand_games');
    }
}
