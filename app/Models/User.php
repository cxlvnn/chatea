<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

#[Fillable(['username', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'last_seen_at' => 'datetime',
        ];
    }

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class, 'user1_id')->orWhere('user2_id', $this->id);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function canJoinRoom($chatId): bool
    {
        $chat = Chat::findOrFail($chatId);

        return $this->id === $chat->user1_id or $this->id === $chat->user2_id;
    }

    public function isOnline(): bool
    {
        $now = Carbon::now();
        $cutoff = $now->subSeconds(90);

        return $this->last_seen_at !== null && $this->last_seen_at->greaterThan($cutoff);
    }
}
