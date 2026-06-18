<?php

namespace App\Http\Controllers;

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
        return Inertia::render('chat/Show', ['chat' => new ChatResource($chat)]);
    }

    public function create(AddNewChatRequest $request)
    {
        if ($user = User::firstWhere('username', $request->validated('username'))) {
            if ($request->username === Auth::user()->username) {
                return back()->withErrors(['username' => 'Can not create a chat with yourself']);
            }

            $chat = Chat::create([
                'user1_id' => Auth::user()->id,
                'user2_id' => $user->id,
            ]);

            return to_route('chat.index');
        }

        return back()->withErrors(['username' => 'This username does not exist']);
    }
}
