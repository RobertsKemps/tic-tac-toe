<?php

use App\Http\Controllers\BoardController;
use Illuminate\Support\Facades\Route;
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

Route::inertia('/', 'Welcome')->name('index');
Route::get('basic', [BoardController::class, 'basicGame'])->name('game.basic');
Route::get('versus/bot', [BoardController::class, 'versusBot'])->name('game.versus.bot');
Route::get('versus/player', [BoardController::class, 'versusPlayer'])->name('game.versus.player');

Route::get('/versus/player/move-made', [BoardController::class, 'moveMade'])->name('game.versus.player.move');
