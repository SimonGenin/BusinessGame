<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;

class CournotGame extends Model
{
    protected $casts = [
        'game_urls' => 'array',
        'plays'     => 'array',
        'number_of_players' => 'array',
        'payoffs' => 'array',
        'isFinished' => 'boolean'
    ];

    protected $guarded = [];

    protected $hidden = [
        'game_urls' // Ensure the player don't look up the JS and find
        // how to play for the other players
    ];

    /**
     * Generates urls to access the game
     */
    public function generateUrls()
    {
        // we need a url to see the results
        $prof_url = 'cournot/'.urlencode($this->name).'/professor/'.Str::random(8);

        // we need a url to play as each player
        $player_urls = [];
        for ($i = 0; $i < $this->number_of_players; $i++) {
            $player_urls['player-'.$i] = 'cournot/'.urlencode($this->name).'/player-'.$i.'/'.Str::random(8);
        }

        $this->game_urls = ['professor_url' => $prof_url, 'student_urls' => $player_urls];
    }

    public function formula($turn) {

        $payoffs = [];

        for ( $i = 0 ; $i < $this->number_of_players ; $i++ ) {


            if ($i % 2 == 0) {

                $payoffs['player-' . $i] = [];
                $payoffs['player-' . ($i + 1)] = [];


                $played = $this->plays['turn-' . $turn]['player-' . $i]['play'] ?? 0;
                $playedOpponent = $this->plays['turn-' . $turn]['player-' . ($i + 1)]['play'] ?? 0;

                $payoffs['player-' . $i]['payoff'] = $this->payoff($played, $playedOpponent);
                $payoffs['player-' . ($i + 1)]['payoff'] = $this->payoff($playedOpponent, $played);

            }

        }

        $default = $this->payoffs;
        $default['turn-' . $turn] = $payoffs;


        $this->payoffs = $default;
        $this->update();

    }

    public function payoff($a, $b) {

        return $a * (90 - ($a + $b));

    }

    public function preparePlaysArray()
    {

        $plays = [];
        $plays['current_turn'] = 0;

        for ($i = 0; $i < $this->number_of_turns; $i++) {

            $plays['turn-'.$i] = [];
            $plays['turn-'.$i]['closed'] = false;

            for ($p = 0; $p < $this->number_of_players; $p++) {
                $plays['turn-' . $i]['player-' . $p] = [];
                $plays['turn-' . $i]['player-' . $p]['play'] = null;
                $plays['turn-' . $i]['player-' . $p]['name'] = '';
            }

        }

        $this->plays = $plays;
    }



    public function generateHash()
    {
        $this->hashed_link = Str::random();
    }
}
