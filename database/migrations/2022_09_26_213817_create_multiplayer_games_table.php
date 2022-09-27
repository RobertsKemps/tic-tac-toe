<?php

declare(strict_types=1);

use App\Models\MultiplayerGame;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('multiplayer_games', function (Blueprint $table) {
            $table->id();
            $table->string('player_x_session_id');
            $table->string('player_o_session_id')->nullable();
            $table->json('board_state');
            $table->char('active_move', 1)->default('X');
            $table->tinyInteger('status')->default(MultiplayerGame::STATUS__WAITING_FOR_PLAYER_O);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('multiplayer_games');
    }
};
