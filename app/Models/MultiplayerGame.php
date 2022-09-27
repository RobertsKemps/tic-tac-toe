<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiplayerGame extends Model
{
    use HasFactory;

    public const PLAYER_X = 'X';
    public const PLAYER_O = 'O';

    public const STATUS__WAITING_FOR_PLAYER_O = 0;
    public const STATUS__GAME_STARTED = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['player_x_session_id'];

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
        'board_state' => '[["", "", ""], ["", "", ""], ["", "", ""]]',
    ];
}
