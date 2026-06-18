<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Requests\UpdateProfileRequest;
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

        return to_route('chat.index');
    }

    public function login(LoginUserRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            return to_route('chat.index');
        }

        return back()->withErrors(['username' => 'Provided credentials do not match our records']);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function profile()
    {
        return Inertia::render('auth/Profile', ['user' => Auth::user()]);
    }

    public function update_profile(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $user->update($request->validated());

        return to_route('profile');
    }
}
