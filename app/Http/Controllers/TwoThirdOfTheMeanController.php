<?php

namespace App\Http\Controllers;

use App\TwoThirdOfTheMean;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\URL;


class TwoThirdOfTheMeanController extends Controller
{

    public function show($game, $name, $slug) {

        $student_path = join([$game, $name, 'players', $slug], '/');
        $prof_path = join([$game, $name, 'professor', $slug], '/');

        $game = DB::table('two_third_of_the_means')->whereJsonContains('game_urls', ['student_url' => $student_path])->orWhereJsonContains('game_urls', ['professor_url' => $prof_path])->first();


        $game = TwoThirdOfTheMean::findOrFail($game->id);


        $done_turns = $game->plays['current_turn'] - 1;

        $payoffs = [];


        if ($done_turns >= 0) {

            for ($i = 0 ; $i <= $done_turns ; $i++) {

                $key = 'turn-' . $i;
                $payoffs += array( $key => $game->formula($i));

            }

        }

        return Inertia::render('TwoThirdOfTheMeanPlay.vue', compact('game', 'payoffs'));

    }

    public function storePlay() {

        // We use the game from DB to be sure there's not alteration.
        // We should try to make sure the player is right as well. (using the slug)

        $request = \request();

        $game_id = $request->get('game_id');
        $url = $request->get('url');
        $game = TwoThirdOfTheMean::find($game_id);

        // todo validate value !!!
        $value = $request->get('value');
        $name = $request->get('name');
        $current_turn = $game->plays['current_turn'];
        $plays = $game->plays;

        $plays['turn-' . $current_turn][$name] = $value;

        $game->plays = $plays;

        $game->update();

        return $url;

    }

    public function closeRound()
    {
        $game_id = \request()->get('game_id');
        $game = TwoThirdOfTheMean::find($game_id);
        $url = request()->get('url');

        $plays= $game->plays;

        $current_turn = $game->plays['current_turn'];
        $plays['current_turn'] = $current_turn + 1;


        $game->plays = $plays;

        $game->update();

        return $url;
    }

    public function launch() {

        $round_number = \request()->get('turnNumber');
        $name = \request()->get('name');

        /** @var TwoThirdOfTheMean $game */
        $game = TwoThirdOfTheMean::make([
            'name' => $name,
            'number_of_turns' => $round_number,
        ]);

        $game->generateHash();
        $game->preparePlaysArray();
        $game->generateUrls();
        $game->save();

        return \redirect()->route('links.two-third', ['hash' => $game->hashed_link]);

    }

    public function links($hash) {

        $game = TwoThirdOfTheMean::whereHashedLink($hash)->firstOrFail();

        $url_start = URL::to('/play');

        $game_urls = $game->game_urls;

        $finished = $game->number_of_turns == $game->plays['current_turn'] ;


        return Inertia::render('InfoTwoThirdOfTheMean', compact('game', 'url_start', 'game_urls', 'finished'));

    }


}
