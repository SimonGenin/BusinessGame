<?php

use App\BertrandGame;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/about', function () {
    return Inertia::render('About');
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
});

Route::get('/tests', function () {
    return Inertia::render('Tests');
});

Route::get('/launch', 'LauncherController@index')->name('laucher.index');
Route::post('/launch', 'LauncherController@start')->name('laucher.start');

Route::get('play/{slug}', 'PlayController@index')->name('play.index');

Route::get('test/{game}/{name}/{player}/{slug}', function ($game, $name, $player, $slug) {

    $path = join([$game, $name, $player, $slug], '/');

    $game = DB::table('bertrand_games')->whereJsonContains('game_urls', ['student_urls' => [ $player => $path]])->orWhereJsonContains('game_urls', ['professor_url' => $path ])->get();

    return $game;
});
