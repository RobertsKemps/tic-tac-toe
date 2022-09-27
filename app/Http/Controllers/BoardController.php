<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\GameStarted;
use App\Events\MoveMade;
use App\Services\MultiplayerGameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class BoardController extends Controller
{
    private MultiplayerGameService $multiplayerGameService;

    public function __construct(MultiplayerGameService $multiplayerGameService)
    {
        $this->multiplayerGameService = $multiplayerGameService;
    }

    /**
     * @return Response
     */
    public function basicGame(): Response
    {
        return Inertia::render('BasicBoard', ['versusBot' => false]);
    }

    /**
     * @return Response
     */
    public function versusBot(): Response
    {
        return Inertia::render('BasicBoard', ['versusBot' => true]);
    }

    /**
     * @return Response
     */
    public function versusPlayer(): Response
    {
        $playerId = Str::random(10);
        $match = $this->multiplayerGameService->createGame($playerId);

        return Inertia::render('VersusPlayer', ['playerId' => $playerId, 'player', 'matchId' => $match->id]);
    }

    /**
     * @param Request $request
     */
    public function moveMade(Request $request): void
    {
        $this->multiplayerGameService->makeMove($request->get('matchId'), $request->get('playerValue'), $request->get('board'));
    }
}
