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
            'initial' => $user->username[0],

            /* 'relationships' => [ */
            /*     'lastMessage' => $this->last_message(), */
            /* ], */
        ];
    }
}
