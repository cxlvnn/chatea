<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use function Symfony\Component\Clock\now;

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
        $user->last_seen_at = now();
        $user->save();

        return to_route('chats.index');
    }

    public function login(LoginUserRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $user = $request->user();
            $request->session()->regenerate();

            $user->last_seen_at = now();
            $user->save();

            return to_route('chats.index');
        }

        return back()->withErrors(['username' => 'Provided credentials do not match our records']);
    }

    public function logout()
    {
        $user = request()->user();
        Auth::logout();

        $user->last_seen_at = null;
        $user->save();

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
