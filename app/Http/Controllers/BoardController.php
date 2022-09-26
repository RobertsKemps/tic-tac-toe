<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
}