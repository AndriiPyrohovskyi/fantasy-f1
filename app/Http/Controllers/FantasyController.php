<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FantasyController extends Controller
{
    public function dashboard()
    {
        return view('fantasy.dashboard', [
            'title' => 'Fantasy F1 Dashboard'
        ]);
    }
    public function drivers()
    {
        $drivers = [
            ['name' => 'Max Verstappen', 'team' => 'Red Bull', 'points' => 575, 'price' => 32.5],
            ['name' => 'Lando Norris', 'team' => 'McLaren', 'points' => 356, 'price' => 28.0],
            ['name' => 'Charles Leclerc', 'team' => 'Ferrari', 'points' => 308, 'price' => 26.5],
            ['name' => 'Oscar Piastri', 'team' => 'McLaren', 'points' => 292, 'price' => 24.0],
        ];

        return view('fantasy.drivers', [
            'title' => 'F1 Drivers',
            'drivers' => $drivers
        ]);
    }
    public function teams()
    {
        $teams = [
        ];

        return view('fantasy.teams', [
            'title' => 'F1 Teams',
            'teams' => $teams
        ]);
    }
    public function leaderboard()
    {
        return view('fantasy.leaderboard', [
            'title' => 'Fantasy Leaderboard'
        ]);
    }

    public function skills()
    {
        return response()->json([
            'message' => 'Driver skills API',
            'skills' => []
        ]);
    }
}
