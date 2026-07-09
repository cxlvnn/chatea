<?php

namespace App\Models;

use Database\Factories\ChatFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    /** @use HasFactory<ChatFactory> */
    use HasFactory;

    protected $guarded = [];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function user_1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    public function user_2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    public function other_user(): User
    {
        return $this->user1_id === Auth::id() ? $this->user_2 : $this->user_1;
    }
}
