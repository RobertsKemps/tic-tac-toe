<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\MultiplayerGame;

class MultiplayerGameRepository
{
    public function getGameById(int $id)
    {
        return MultiplayerGame::find($id);
    }

    /**
     * @param string $sessionId
     * @return mixed
     */
    public function createNewGame(string $sessionId): mixed
    {
        return MultiplayerGame::create(['player_x_session_id' => $sessionId]);
    }

    /**
     * @return mixed
     */
    public function waitingForPlayerO(): mixed
    {
        return MultiplayerGame::where('status', MultiplayerGame::STATUS__WAITING_FOR_PLAYER_O)->first();
    }

    /**
     * @param string $playerSessionId
     * @return mixed
     */
    public function userHasActiveGame(string $playerSessionId): mixed
    {
        return MultiplayerGame::where('status', MultiplayerGame::STATUS__GAME_STARTED)
            ->where(function ($query) use ($playerSessionId) {
                $query->where('player_x_session_id', $playerSessionId)
                    ->orWhere('player_o_session_id', $playerSessionId);
            })->first();
    }


    /**
     * @param string $session
     * @return mixed
     */
    public function getUserActiveGameSession(string $session): mixed
    {
        return MultiplayerGame::where();
    }
}
