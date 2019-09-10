<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\BertrandGame
 *
 * @property int $id
 * @property string $name
 * @property string $hashed_link
 * @property int $number_of_turns
 * @property int $number_of_players
 * @property array $game_urls
 * @property array $plays
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BertrandGame newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BertrandGame newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BertrandGame query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BertrandGame whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BertrandGame whereGameUrls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BertrandGame whereHashedLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BertrandGame whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BertrandGame whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BertrandGame whereNumberOfPlayers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BertrandGame whereNumberOfTurns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BertrandGame wherePlays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BertrandGame whereUpdatedAt($value)
 */
	class BertrandGame extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

