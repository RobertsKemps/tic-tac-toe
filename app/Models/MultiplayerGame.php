<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiplayerGame extends Model
{
    use HasFactory;

    public const PLAYER_X = 'X';
    public const PLAYER_O = 'O';

    public const OUTCOME__WAITING_FOR_PLAYER_O = 0;
    public const OUTCOME__GAME_STARTED = 1;
    public const OUTCOME__GAME_WON_BY_X = 2;
    public const OUTCOME__GAME_WON_BY_O = 3;
    public const OUTCOME__GAME_TIED = 4;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'board_state' => 'array',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'board_state' => [["", "", ""], ["", "", ""], ["", "", ""]],
    ];
}
