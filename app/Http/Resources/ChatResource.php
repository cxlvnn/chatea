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
        return [
            'id' => $this->id,
            'username' => $this->user_2->username,
            'initial' => $this->user_2->username[0],

            /* 'relationships' => [ */
            /*     'lastMessage' => $this->last_message(), */
            /* ], */
        ];
    }
}
