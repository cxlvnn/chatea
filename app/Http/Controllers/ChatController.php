<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNewChatRequest;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Auth::user()->chats;

        return Inertia::render('Chat', ['chats' => $chats]);
    }

    public function create(AddNewChatRequest $request)
    {
        if ($user = User::firstWhere('username', $request->validated('username'))) {
            $chat = Chat::create([
                'user_1' => Auth::user()->id,
                'user_2' => $user->id,
            ]);

            return to_route('chat.index');
        }

        return back()->withErrors(['username' => 'This username does not exist']);
    }
}
