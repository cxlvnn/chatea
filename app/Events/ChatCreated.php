<?php

namespace App\Events;

use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Models\User;
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
        $user = User::findOrFail($this->userId);

        return [
            'chat' => [
                'id' => $this->chat->id,
                'username' => $user->username,
                'initial' => $user->username[0],

                'relationships' => [
                    'messages' => MessageResource::collection($this->chat->messages()->with('sender')->get()),
                ],

            ],
        ];
    }

    public function broadcastAs()
    {
        return 'chat.created';
    }
}
