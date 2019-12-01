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

namespace App{
/**
 * App\TwoThirdOfTheMean
 *
 * @property int $id
 * @property string $name
 * @property string $hashed_link
 * @property int $number_of_turns
 * @property array $game_urls
 * @property array $plays
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TwoThirdOfTheMean newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TwoThirdOfTheMean newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TwoThirdOfTheMean query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TwoThirdOfTheMean whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TwoThirdOfTheMean whereGameUrls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TwoThirdOfTheMean whereHashedLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TwoThirdOfTheMean whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TwoThirdOfTheMean whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TwoThirdOfTheMean whereNumberOfTurns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TwoThirdOfTheMean wherePlays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TwoThirdOfTheMean whereUpdatedAt($value)
 */
	class TwoThirdOfTheMean extends \Eloquent {}
}

namespace App{
/**
 * App\CournotGame
 *
 * @property int $id
 * @property string $name
 * @property string $hashed_link
 * @property int $number_of_turns
 * @property array $number_of_players
 * @property array $game_urls
 * @property array $plays
 * @property array $payoffs
 * @property bool $isFinished
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CournotGame newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CournotGame newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CournotGame query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CournotGame whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CournotGame whereGameUrls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CournotGame whereHashedLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CournotGame whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CournotGame whereIsFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CournotGame whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CournotGame whereNumberOfPlayers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CournotGame whereNumberOfTurns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CournotGame wherePayoffs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CournotGame wherePlays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CournotGame whereUpdatedAt($value)
 */
	class CournotGame extends \Eloquent {}
}

namespace App{
/**
 * App\RepeatedInmateDilemma
 *
 * @property int $id
 * @property string $name
 * @property string $hashed_link
 * @property int $number_of_turns
 * @property array $number_of_players
 * @property array $game_urls
 * @property array $plays
 * @property array $payoffs
 * @property bool $isFinished
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RepeatedInmateDilemma newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RepeatedInmateDilemma newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RepeatedInmateDilemma query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RepeatedInmateDilemma whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RepeatedInmateDilemma whereGameUrls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RepeatedInmateDilemma whereHashedLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RepeatedInmateDilemma whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RepeatedInmateDilemma whereIsFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RepeatedInmateDilemma whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RepeatedInmateDilemma whereNumberOfPlayers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RepeatedInmateDilemma whereNumberOfTurns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RepeatedInmateDilemma wherePayoffs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RepeatedInmateDilemma wherePlays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RepeatedInmateDilemma whereUpdatedAt($value)
 */
	class RepeatedInmateDilemma extends \Eloquent {}
}

