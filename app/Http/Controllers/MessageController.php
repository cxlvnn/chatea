<?php

namespace App\Http\Controllers;

use App\Events\MessageDeleted;
use App\Events\MessageSent;
use App\Http\Requests\EditMessageRequest;
use App\Http\Requests\SendMessageRequest;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SendMessageRequest $request, Chat $chat)
    {
        $message = $chat->messages()->create([
            'user_id' => Auth::id(),
            'content' => $request->validated('content'),
        ]);

        $chat->update([
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return to_route('chats.show', ['chat' => $chat]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditMessageRequest $request, Message $message)
    {
        if ($message->user_id === Auth::id()) {
            $message->update($request->validated());
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        if ($message->user_id === Auth::id()) {
            broadcast(new MessageDeleted($message));
            $message->delete();
        }
    }
}
