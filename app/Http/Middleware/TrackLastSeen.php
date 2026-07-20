<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function Symfony\Component\Clock\now;

class TrackLastSeen
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($user = $request->user()) {
            if ($user->last_seen_at === null
                 || $user->last_seen_at->diffInSeconds(now()) > 30) {
                $user->forceFill(['last_seen_at' => now()])->save();
            }
        }

        return $next($request);
    }
}
