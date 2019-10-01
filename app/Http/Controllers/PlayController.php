<?php

namespace App\Http\Controllers;

use App\BertrandGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;


class PlayController extends Controller
{
    public function index ($game, $name, $player, $slug) {

        $path = join([$game, $name, $player, $slug], '/');

        $game = DB::table('bertrand_games')->whereJsonContains('game_urls', ['student_urls' => [ $player => $path]])->orWhereJsonContains('game_urls', ['professor_url' => $path ])->first();

        // $game->updateCurrentTurnBasedOnTimeConstraint();

        $game = BertrandGame::findOrFail($game->id);


        $done_turns = $game->plays['current_turn'] - 1;


        $payoffs = [];

        if ($done_turns >= 0) {

            for ($i = 0 ; $i <= $done_turns ; $i++) {

                $key = 'turn-' . $i;
                $payoffs += array( $key => $game->formula($i));

            }

        }


        return Inertia::render('Play.vue', compact('game', 'player', 'payoffs'));

    }

    public function store(Request $request) {

        // We use the game from DB to be sure there's not alteration.
        // We should try to make sure the player is right as well. (using the slug)

        $game_id = $request->get('game_id');
        $url = $request->get('url');
        $game = BertrandGame::find($game_id);

        // todo validate value !!!
        $value = $request->get('value');

        $value = max(0, min($value, 100));

        $playerJsonName = $request->get('player');

        $current_turn = $game->plays['current_turn'];
        $plays = $game->plays;

        $plays['turn-' . $current_turn][$playerJsonName] = $value;

        // Update current turn only if everyone has played.
        if ( count($plays['turn-' . $current_turn]) === $game->number_of_players)
            $plays['current_turn'] = $current_turn + 1;

        $game->plays = $plays;

        $game->update();

        return $url;

    }
}


