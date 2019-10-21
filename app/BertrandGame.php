<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Integer;

class BertrandGame extends Model
{

    protected $casts = [
        'game_urls' => 'array',
        'plays'     => 'array',
    ];

    protected $guarded = [];

    protected $hidden = [
        'game_urls' // Ensure the player don't look up the JS and find
        // how to play for the other players
    ];

    private $default_price = 100.0;

    private $timer = 20; // seconds

    /**
     * Generates urls to access the game
     */
    public function generateUrls()
    {
        // we need a url to see the results
        $prof_url = 'bertrand-game/'.urlencode($this->name).'/professor/'.Str::random(8);

        // we need a url to play as each player
        $player_urls = [];
        for ($i = 0; $i < $this->number_of_players; $i++) {
            $player_urls['player-'.$i] = 'bertrand-game/'.urlencode($this->name).'/player-'.$i.'/'.Str::random(8);
        }

        $this->game_urls = ['professor_url' => $prof_url, 'student_urls' => $player_urls];
    }

    public function preparePlaysArray()
    {

        $plays = [];
        $plays['current_turn'] = 0;

        for ($i = 0; $i < $this->number_of_turns; $i++) {

            $plays['turn-'.$i] = [];
        }

        $this->plays = $plays;
    }

    public function generateHash()
    {

        $this->hashed_link = Str::random();
    }

    public function profit($p, $f)
    {
        return ((100 - $p) * ($p - 10)) / $f;
    }

    public function formula($turn)
    {
        $plays = $this->plays['turn-'.$turn];

        $smallestValue = null;
        $counter = 0;

        foreach ($plays as $player_string => $play_value) {

            if ($smallestValue == null) {
                $smallestValue = $play_value;
                $counter = 0;
            }

            if ($smallestValue < $play_value) {
                $smallestValue = $play_value;
                $counter = 0;
            }

            $counter++;
        }

        $payoffs = [];
        foreach ($plays as $player_string => $play_value) {

            if ($play_value === $smallestValue) {
                $payoffs += [$player_string => $this->profit($smallestValue, $counter)];
            } else {
                $payoffs += [$player_string => 0];
            }
        }

        return $payoffs;

    }
}

