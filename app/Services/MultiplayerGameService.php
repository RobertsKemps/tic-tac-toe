<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\GameStarted;
use App\Events\MoveMade;
use App\Models\MultiplayerGame;
use App\Repositories\MultiplayerGameRepository;

class MultiplayerGameService
{
    private MultiplayerGameRepository $multiplayerGameRepository;

    public function __construct(MultiplayerGameRepository $multiplayerGameRepository)
    {
        $this->multiplayerGameRepository = $multiplayerGameRepository;
    }

    /**
     * @param string $userSession
     *
     * @return mixed
     */
    public function createGame(string $userSession): mixed
    {
        $hasActiveGame = $this->multiplayerGameRepository->userHasActiveGame($userSession);

        //Return last active game to not duplicate the game after refresh
        if ($hasActiveGame) {
            return $hasActiveGame;
        }

        $waitingForPlayerTwo = $this->multiplayerGameRepository->waitingForPlayerO();

        if (!$waitingForPlayerTwo) {
            return $this->multiplayerGameRepository->createNewGame($userSession);
        }

        //Start a match if a player is waiting on someone to join
        $waitingForPlayerTwo->player_o_session_id = $userSession;
        $waitingForPlayerTwo->status = MultiplayerGame::STATUS__GAME_STARTED;
        $waitingForPlayerTwo->save();

        GameStarted::dispatch($waitingForPlayerTwo->id, $waitingForPlayerTwo->player_x_session_id);

        return $waitingForPlayerTwo;
    }

    /**
     * @param int $matchId
     * @param string $playerValue
     * @param string $playerId
     * @param array $board
     */
    public function makeMove(int $matchId, string $playerValue, array $board): void
    {
        $match = $this->multiplayerGameRepository->getGameById($matchId);
        $match->board_state = $board;
        $match->save();

        $nextPlayersMove = ($playerValue === MultiplayerGame::PLAYER_X) ? MultiplayerGame::PLAYER_O : MultiplayerGame::PLAYER_X;

        MoveMade::dispatch($board, $nextPlayersMove, $matchId);
    }

}
