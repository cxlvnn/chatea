<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Chat');
})->name('chat.index');

Route::get('/login', [AuthController::class, 'show_login'])->name('login.show');
Route::get('/register', [AuthController::class, 'show_register'])->name('register.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
