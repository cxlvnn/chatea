<?php

namespace App\Policies;

use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class ChatPolicy
{
    public function viewOrModify(Chat $chat)
    {
        return Auth::id() === $chat->user1_id or Auth::id() === $chat->user2_id;
    }
}
