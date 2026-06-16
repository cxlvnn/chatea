<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function show_register()
    {
        return Inertia::render('auth/Register');
    }

    public function show_login()
    {
        return Inertia::render('auth/Login');
    }

    public function register(RegisterUserRequest $request)
    {
        $user = User::create($request->validated());

        Auth::login($user);

        return to_route('chat.index', [
            'user' => $user,
        ]);
    }
}
