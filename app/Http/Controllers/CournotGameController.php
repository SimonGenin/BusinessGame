<?php

namespace App\Http\Controllers;

use App\CournotGame;
use App\RepeatedInmateDilemma;
use App\TwoThirdOfTheMean;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use URL;

class CournotGameController extends Controller
{

    public function show($name, $player, $slug) {

        $student_path = join(['cournot', $name, $player, $slug], '/');
        $prof_path = join(['cournot', $name, 'professor', $slug], '/');

        $game = DB::table('cournot_games')->whereJsonContains('game_urls', ['student_urls' => [ $player => $student_path]])->orWhereJsonContains('game_urls', ['professor_url' => $prof_path])->first();

        $game = CournotGame::findOrFail($game->id);

        $payoffs = $game->payoffs;

        return Inertia::render('CournotGamePlay', compact('game', 'player', 'payoffs'));

    }


    public function launch() {

        $player_number =  \request()->get('playerNumber');
        $round_number = \request()->get('turnNumber');
        $name = \request()->get('name');

        if ($player_number % 2 != 0) {
            $player_number++;
        }

        /** @var CournotGame $game */
        $game = CournotGame::make([
            'name' => $name,
            'number_of_players' => $player_number,
            'number_of_turns' => $round_number,
        ]);

        $game->payoffs = [];

        $game->generateHash();
        $game->preparePlaysArray();
        $game->generateUrls();
        $game->save();

        return \redirect()->route('links.cournot', ['hash' => $game->hashed_link]);

    }

    public function closeRound() {

        $game_id = \request()->get('game_id');
        $game = CournotGame::find($game_id);
        $url = request()->get('url');

        $plays= $game->plays;

        $current_turn = $game->plays['current_turn'];
        $plays['turn-' . $current_turn]['closed'] = true;

        $game->formula($current_turn);

        $current_turn++;

        if ($game->number_of_turns == $current_turn) {
            $current_turn--; // to avoid overflow
            $game->isFinished = true;
        }

        $plays['current_turn'] = $current_turn;


        $game->plays = $plays;

        $game->update();

        return $url;

    }

    public function storePlay() {

        // We use the game from DB to be sure there's not alteration.
        // We should try to make sure the player is right as well. (using the slug)

        $request = \request();

        $game_id = $request->get('game_id');
        $url = $request->get('url');
        $value = $request->get('value');
        $player = $request->get('player');
        $name = $request->get('name');

        $value = max(0, min($value, 45));

        $game = CournotGame::find($game_id);

        $current_turn = $game->plays['current_turn'];
        $plays = $game->plays;

        $plays['turn-' . $current_turn][$player] = [];
        $plays['turn-' . $current_turn][$player]['name'] = $name;
        $plays['turn-' . $current_turn][$player]['play'] = $value;

        $game->plays = $plays;

        $game->update();

        return $url;

    }

    public function links($hash) {

        $game = CournotGame::whereHashedLink($hash)->firstOrFail();

        $url_start = URL::to('/play');

        $game_urls = $game->game_urls;

        return Inertia::render('InfoCournotGame', compact('game', 'url_start', 'game_urls'));

    }
}
