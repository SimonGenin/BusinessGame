<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepetedInmateDilemmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repeated_inmate_dilemmas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('hashed_link');
            $table->integer('number_of_turns');
            $table->json('number_of_players');
            $table->json('game_urls');
            $table->json('plays');
            $table->json('payoffs');

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
        Schema::dropIfExists('repeated_inmate_dilemmas');
    }
}
