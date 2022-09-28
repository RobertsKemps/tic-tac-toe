<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MoveMade implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private array $board;
    private string $nextPlayerMove;
    private int $matchId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $board, string $nextPlayerMove, int $matchId)
    {
        $this->board = $board;
        $this->nextPlayerMove = $nextPlayerMove;
        $this->matchId = $matchId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
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
            'board' => $this->board,
            'nextPlayerMove' => $this->nextPlayerMove,
            'matchId' => (string)$this->matchId,
        ];
    }
}
