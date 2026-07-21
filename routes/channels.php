<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{chatId}', function (User $user, $chatId) {
    $chat = Chat::findOrFail($chatId);

    return in_array($user->id, [$chat->user1_id, $chat->user2_id]);
});

Broadcast::channel('user.{userId}', function (User $user, $userId) {
    return $user->id == $userId;
});

Broadcast::channel('online', function (User $user) {
    return [
        'id' => $user->id,
        'username' => $user->username,
    ];
});
