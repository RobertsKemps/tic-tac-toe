<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\MoveMade;
use Inertia\Inertia;
use Inertia\Response;

class BoardController extends Controller
{
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
        return Inertia::render('VersusPlayer');
    }

    public function moveMade()
    {
        MoveMade::dispatch();
    }
}
