<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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


    private $timer = 2 * 60; // seconds

    /**
     * Generates urls to access the game
     */
    public function generateUrls()
    {
        // we need a url to see the results
        $prof_url = 'two-third-of-the-mean/'.urlencode($this->name).'/professor/'. Str::random(16);

        // we need a url for the players
        $player_url = 'two-third-of-the-mean/'.urlencode($this->name).'/players/'.Str::random(16);

        $this->game_urls = ['professor_url' => $prof_url, 'student_url' => $player_url];
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

    public function formula($turn)
    {
        $plays = $this->plays['turn-'.$turn];

        $total = 0;

        $player_count = 0;
        foreach ($plays as $player_string => $play_value) {

            $total += $play_value;
            $player_count += 1;

        }

        $mean = $total / max(1, $player_count);
        $twoThird = 2 / 3 * $mean;


        uasort($plays, function ($a, $b) use ($twoThird) {
            return  abs($twoThird - $a) > abs($twoThird - $b);
        });

        $values = [];
        $players = [];

        foreach ($plays as $key => $el) {
            array_push($values, $el);
            array_push($players, $key);
        }

        return array('values' => $plays, 'players' => $players, 'mean' => round($mean, 2), 'two_third' => round($twoThird, 2));

    }
}
