<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FantasyController extends Controller
{
    public function fantasy()
    {
        return view('fantasy.fantasy', [
            'title' => 'F1',
        ]);
    }
    public function drivers()
    {
        $drivers = [
            ['name' => 'Max Verstappen', 'team' => 'Red Bull'],
            ['name' => 'Lando Norris', 'team' => 'McLaren'],
            ['name' => 'Charles Leclerc', 'team' => 'Ferrari'],
            ['name' => 'Oscar Piastri', 'team' => 'McLaren'],
        ];

        return view('fantasy.drivers', [
            'title' => 'F1 Drivers',
            'drivers' => $drivers
        ]);
    }
    public function teams()
    {
        $teams = [
            ['name' => 'McLaren', 'drivers' => [['name' => 'Lando Norris'], ['name' => 'Oscar Piastri']]]
        ];

        return view('fantasy.teams', [
            'title' => 'F1 Teams',
            'teams' => $teams
        ]);
    }
    public function races()
    {
        return view('fantasy.races', [
            'title' => 'F1',
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
        return view('fantasy.skills', [
            'title' => 'F1',
        ]);
    }
}
