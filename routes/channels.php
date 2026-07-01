<?php

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('message.{messageId}', function (User $user, $messageId) {
    $message = Message::findOrFail($messageId);
    $chat = $message->chat_id;

    return ($user->id === $chat->user1_id) || ($user->id === $chat->user2_id);
});
