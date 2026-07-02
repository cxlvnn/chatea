<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{chatId}', function (User $user, $chatId) {
    $chat = Chat::findOrFail($chatId);

    return $user->id === $chat->user1_id or $user->id === $chat->user2_id;
});
