<?php

namespace App\Http\Resources;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this->other_user();
        $last_message = Message::query()
            ->where('chat_id', $this->id)
            ->latest()
            ->first();

        return [
            'id' => $this->id,
            'username' => $user->username,
            'initial' => $user->username[0],

            'relationships' => [
                'lastMessage' => $last_message->content,
                'lastMessageAt' => $last_message->created_at->format('H:i'),
            ],
        ];
    }
}
