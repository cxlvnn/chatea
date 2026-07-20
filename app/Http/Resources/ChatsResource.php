<?php

namespace App\Http\Resources;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function Symfony\Component\Clock\now;

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
        $last_message_at = null;
        if ($last_message = Message::query()
            ->where('chat_id', $this->id)
            ->latest()
            ->first()) {

            $now = now();
            $last_message_at = $last_message->created_at;
            $interval = $now->diff($last_message_at);
            if ($interval->days > 0) {
                $last_message_at = $last_message->created_at->format('m/d/y');
            } else {
                $last_message_at = $last_message->created_at->format('H:i');

            }
        }

        return [
            'id' => $this->id,
            'username' => $user->username,
            'initial' => $user->username[0],
            'isOnline' => $user->isOnline(),

            'relationships' => [
                'lastMessage' => $last_message ? $last_message->content : null,
                'lastMessageAt' => $last_message_at,
            ],
        ];
    }
}
