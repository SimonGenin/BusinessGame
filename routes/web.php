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

    $game = \App\RepeatedInmateDilemma::find(2);


    $game->formula(0);

    return $game;

});



Route::post('/launch/two-third', 'TwoThirdOfTheMeanController@launch')->name('launcher.start.two-third');
Route::post('/launch/dilemma', 'RepeatedInmateDilemmaController@launch')->name('launcher.start.dilemma');

Route::get('/links/two-third/{hash}', 'TwoThirdOfTheMeanController@links')->name('links.two-third');
Route::get('/links/dilemma/{hash}', 'RepeatedInmateDilemmaController@links')->name('links.dilemma');

Route::get('play/two-third-of-the-mean/{name}/players/{slug}', 'TwoThirdOfTheMeanController@show');
Route::get('play/two-third-of-the-mean/{name}/professor/{slug}', 'TwoThirdOfTheMeanController@show');

Route::get('play/repeated-inmate-dilemma/{name}/{player}/{slug}', 'RepeatedInmateDilemmaController@show');
Route::get('play/repeated-inmate-dilemma/{name}/professor/{slug}', 'RepeatedInmateDilemmaController@show');

Route::get('play/{game}/{name}/{player}/{slug}', 'PlayController@index')->name('play.index');


Route::post('play', 'PlayController@store')->name('play.store');
Route::post('play/dilemma', 'RepeatedInmateDilemmaController@storePlay')->name('play.dilemma.store');
Route::post('play/two-third', 'TwoThirdOfTheMeanController@storePlay')->name('play.two-third.store');

Route::post('close-round', 'TwoThirdOfTheMeanController@closeRound');
Route::post('/dilemma/close', 'RepeatedInmateDilemmaController@closeRound');


Route::get('/launch', 'LauncherController@index')->name('launcher.index');
Route::post('/launch', 'LauncherController@start')->name('launcher.start');
Route::get('/links/{hash}', 'LauncherController@links')->name('launcher.links');
