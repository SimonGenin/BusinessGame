<?php

namespace App\Http\Controllers;

use App\BertrandGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

class LauncherController extends Controller
{

    public function index() {
        return Inertia::render('LaunchSession');
    }

    public function start() {

        // todo validation

        $player_number =  \request()->get('playerNumber');
        $round_number = \request()->get('turnNumber');
        $name = \request()->get('name');

        /** @var BertrandGame $game */
        $game = BertrandGame::make([
            'name' => $name,
            'number_of_players' => $player_number,
            'number_of_turns' => $round_number,
        ]);

        $game->generateHash();
        $game->preparePlaysArray();
        $game->generateUrls();
        $game->save();

        return Redirect::route('launcher.links', ['hash' => $game->hashed_link]);

    }

    public function links($hash) {

        $game = BertrandGame::whereHashedLink($hash)->first();
        $url_start = URL::to('/play');

        return Inertia::render('GameInfo', compact('game', 'url_start'));

    }

}
