<?php

namespace App\Http\Controllers;

use App\RepeatedInmateDilemma;
use App\TwoThirdOfTheMean;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use URL;

class RepeatedInmateDilemmaController extends Controller
{

    public function show($name, $player, $slug) {

        $student_path = join(['repeated-inmate-dilemma', $name, $player, $slug], '/');
        $prof_path = join(['repeated-inmate-dilemma', $name, 'professor', $slug], '/');

        $game = DB::table('repeated_inmate_dilemmas')->whereJsonContains('game_urls', ['student_urls' => [ $player => $student_path]])->orWhereJsonContains('game_urls', ['professor_url' => $prof_path])->first();

        $game = RepeatedInmateDilemma::findOrFail($game->id);

        $payoffs = $game->payoffs;

        return Inertia::render('RepeatedInmateDilemmaPlay.vue', compact('game', 'player', 'payoffs'));

    }


    public function launch() {

        $player_number =  \request()->get('playerNumber');
        $round_number = \request()->get('turnNumber');
        $name = \request()->get('name');

        if ($player_number % 2 != 0) {
            $player_number++;
        }

        /** @var RepeatedInmateDilemma $game */
        $game = RepeatedInmateDilemma::make([
            'name' => $name,
            'number_of_players' => $player_number,
            'number_of_turns' => $round_number,
        ]);

        $game->payoffs = [];

        $game->generateHash();
        $game->preparePlaysArray();
        $game->generateUrls();
        $game->save();

        return \redirect()->route('links.dilemma', ['hash' => $game->hashed_link]);

    }

    public function closeRound() {

        $game_id = \request()->get('game_id');
        $game = RepeatedInmateDilemma::find($game_id);
        $url = request()->get('url');

        $plays= $game->plays;

        $current_turn = $game->plays['current_turn'];
        $plays['turn-' . $current_turn]['closed'] = true;

        $game->formula($current_turn);

        $plays['current_turn'] = $current_turn + 1;

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

        $game = RepeatedInmateDilemma::find($game_id);

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

        $game = RepeatedInmateDilemma::whereHashedLink($hash)->firstOrFail();

        $url_start = URL::to('/play');

        $game_urls = $game->game_urls;

        $finished = $game->number_of_turns == $game->plays['current_turn'] ;


        return Inertia::render('InfoRepeatedInmateDilemma', compact('game', 'url_start', 'game_urls', 'finished'));

    }
}
