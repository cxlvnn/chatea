<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/chats', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chats/create', [ChatController::class, 'create'])->name('chat.create');
});

Route::get('/login', [AuthController::class, 'show_login'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'show_register'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout')->middleware('auth');
