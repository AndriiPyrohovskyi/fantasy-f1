<?php

use App\Http\Controllers\FantasyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['query.mode'])->group(function () {
    Route::get('/dashboard', [FantasyController::class, 'dashboard'])->name('dashboard');
    Route::get('/teams', [FantasyController::class, 'teams'])->name('teams');
    Route::get('/drivers', [FantasyController::class, 'drivers'])->name('drivers');
    Route::get('/leaderboard', [FantasyController::class, 'leaderboard'])->name('leaderboard');
    Route::get('/skills', [FantasyController::class, 'skills'])->name('skills');
});
