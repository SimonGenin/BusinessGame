<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwoThirdOfTheMean extends Model
{
    protected $casts = [
        'game_urls' => 'array',
        'plays'     => 'array',
        'number_of_players' => 'array'
    ];

    protected $guarded = [];

    protected $hidden = [
        'game_urls' // Ensure the player don't look up the JS and find
        // how to play for the other players
    ];


    private $timer = 20; // seconds

    /**
     * Generates urls to access the game
     */
    public function generateUrls()
    {
        // we need a url to see the results
        $prof_url = 'two-third-of-the-mean/'.urlencode($this->name).'/professor/'.Str::random(16);

        // we need a url to play as each player
        $player_urls = [];
        for ($i = 0; $i < $this->number_of_players; $i++) {
            $player_urls['player-'.$i] = 'two-third-of-the-mean/'.urlencode($this->name).'/player-'.$i.'/'.Str::random(16);
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

        $total = 0;

        $player_count = 0;
        foreach ($plays as $player_string => $play_value) {

            $total += $play_value;
            $player_count += 1;

        }

        $mean = $total / $player_count;
        $twoThird = 2 / 3 * $mean;

        $payoffs = [];
        foreach ($plays as $player_string => $play_value) {

            $payoffs += array($player_string => 0);

        }

        return $payoffs;

    }
}
