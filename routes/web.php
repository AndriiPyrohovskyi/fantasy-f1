<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Головна сторінка
Route::get('/', [PostController::class, 'index'])->name('home');

// Авторизація
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Пости
Route::resource('posts', PostController::class);
Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.like')->middleware('auth');
Route::post('/posts/{post}/comments', [PostController::class, 'storeComment'])->name('posts.comments.store')->middleware('auth');

// Користувачі та профілі
Route::get('/leaderboard', [UserController::class, 'leaderboard'])->name('leaderboard');
Route::get('/users/{user}', [UserController::class, 'profile'])->name('users.profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
