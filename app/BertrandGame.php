<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BertrandGame extends Model
{
    // todo casting: https://laravel.com/docs/master/eloquent-mutators#attribute-casting

    protected $casts = [
        'game_urls' => 'array',
        'plays' => 'array'
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
        $prof_url = 'bertrand-game/'.urlencode($this->name).'/professor/'.Str::random(16);

        // we need a url to play as each player
        $player_urls = [];
        for ($i = 0; $i < $this->number_of_players; $i++) {
            $player_urls['player-'.$i] = 'bertrand-game/'.urlencode($this->name).'/player-'.$i.'/'.Str::random(16);
        }

        $this->game_urls = ['professor_url' => $prof_url, 'student_urls' => $player_urls];
    }

    public function preparePlaysArray() {

        $plays = [];
        $plays['current_turn'] = 0;

        for ($i = 0 ; $i < $this->number_of_turns ; $i++) {

            $plays['turn-'. $i] = [];

        }

        $this->plays = $plays;
    }

    public function generateHash() {

        $this->hashed_link = Str::random();

    }
}

