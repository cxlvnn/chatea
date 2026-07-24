<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this->other_user();

        return [
            'id' => $this->id,
            'username' => $user->username,
            'otherUserId' => $user->id,

            'relationships' => [
                'messages' => MessageResource::collection($this->messages()->with('sender')->get()),
            ],
        ];
    }
}
