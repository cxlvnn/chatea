<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Chat $chat, public $userId)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user.'.$this->userId),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->chat->id,
            'user1' => [
                'id' => $this->chat->user_1->id,
                'username' => $this->chat->user_1->username,
            ],
            'user2' => [
                'id' => $this->chat->user_2->id,
                'username' => $this->chat->user_2->username,
            ],
        ];
    }

    public function broadcastAs()
    {
        return 'chat.created';
    }
}
