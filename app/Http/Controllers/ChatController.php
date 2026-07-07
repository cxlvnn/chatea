<?php

namespace App\Http\Controllers;

use App\Events\ChatCreated;
use App\Events\ChatDeleted;
use App\Http\Requests\AddNewChatRequest;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function index()
    {
        return Inertia::render('chat/Index');
    }

    public function show(Chat $chat)
    {
        return Inertia::render('chat/Show', [
            'chat' => new ChatResource($chat),
        ]);
    }

    public function create(AddNewChatRequest $request)
    {
        if ($user = User::firstWhere('username', $request->validated('username'))) {
            if ($request->username === Auth::user()->username) {
                return back()->withErrors(['username' => 'Can not create a chat with yourself']);
            }

            $auth_id = Auth::id();
            $user_id = $user->id;

            if (Chat::query()
                ->where(function ($query) use ($auth_id, $user_id) {
                    $query->where('user1_id', $auth_id)
                        ->where('user2_id', $user_id);
                })->orWhere(function ($query) use ($auth_id, $user_id) {
                    $query->where('user1_id', $user_id)
                        ->where('user2_id', $auth_id);
                })->exists()) {
                return back()->withErrors(['username' => 'Chat already exists']);
            }

            $chat = Chat::create([
                'user1_id' => Auth::id(),
                'user2_id' => $user->id,
            ]);

            broadcast(new ChatCreated($chat, $user->id));

            return to_route('chats.show', ['chat' => $chat]);
        }

        return back()->withErrors(['username' => 'This username does not exist']);
    }

    public function destroy(Chat $chat)
    {
        $other_user = $chat->other_user();
        $userId = $other_user->id;
        broadcast(new ChatDeleted($chat, $userId));
        $chat->deleteOrFail();

        return to_route('chats.index');
    }
}
