<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GameStarted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private int $matchId;
    private string $playerXId;

    /**
     * @return void
     */
    public function __construct(int $matchId, string $playerXId)
    {
        $this->matchId = $matchId;
        $this->playerXId = $playerXId;
    }

    /**
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('channel');
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'matchId' => $this->matchId,
            'playerXId' => $this->playerXId,
        ];
    }
}
