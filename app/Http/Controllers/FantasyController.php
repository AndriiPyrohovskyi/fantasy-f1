<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FantasyController extends Controller
{
    public function fantasy()
    {
        $drivers = [[
                'name' => 'Max Verstappen',
                'skills' => [
                    [
                        'skill' => ['name' => 'Майстер обгонів', 'ppa' => 450],
                        'tier' => ['tier' => 1, 'multiplier' => 0.1],
                        'trait' => ['name' => 'Стаблільність', 'multiplier' => 0.5],
                    ],
                    [
                        'skill' => ['name' => 'Майстер обгонів', 'ppa' => 450],
                        'tier' => ['tier' => 1, 'multiplier' => 0.1],
                        'trait' => ['name' => 'Стаблільність', 'multiplier' => 0.5],
                    ],
                    [
                        'skill' => ['name' => 'Майстер обгонів', 'ppa' => 450],
                        'tier' => ['tier' => 1, 'multiplier' => 0.1],
                        'trait' => ['name' => 'Стаблільність', 'multiplier' => 0.5],
                    ],
                ],
                'bonuses' => [
                    ['name' => 'Дощику дощику', 'multiplier' => 0.5],
                    ['name' => 'Кращий за товариша по команді', 'multiplier' => 0.5],
                ]
            ],
            [
                'name' => 'Oscar Piastri',
                'skills' => [
                    [
                        'skill' => ['name' => 'Майстер обгонів', 'ppa' => 450],
                        'tier' => ['tier' => 1, 'multiplier' => 0.1],
                        'trait' => ['name' => 'Стаблільність', 'multiplier' => 0.5],
                    ],
                    [
                        'skill' => ['name' => 'Майстер обгонів', 'ppa' => 450],
                        'tier' => ['tier' => 1, 'multiplier' => 0.1],
                        'trait' => ['name' => 'Стаблільність', 'multiplier' => 0.5],
                    ],
                    [
                        'skill' => ['name' => 'Майстер обгонів', 'ppa' => 450],
                        'tier' => ['tier' => 1, 'multiplier' => 0.1],
                        'trait' => ['name' => 'Стаблільність', 'multiplier' => 0.5],
                    ],
                ],
                'bonuses' => [
                    ['name' => 'Дощику дощику', 'multiplier' => 0.5],
                    ['name' => 'Кращий за товариша по команді', 'multiplier' => 0.5],
                ]
            ],
        ];
        $team = [
            'name' => 'McLaren',
            'skills' => [
                    [
                        'skill' => ['name' => 'Майстер обгонів', 'ppa' => 450],
                        'tier' => ['tier' => 1, 'multiplier' => 0.1],
                        'trait' => ['name' => 'Стаблільність', 'multiplier' => 0.5],
                    ],
                    [
                        'skill' => ['name' => 'Майстер обгонів', 'ppa' => 450],
                        'tier' => ['tier' => 1, 'multiplier' => 0.1],
                        'trait' => ['name' => 'Стаблільність', 'multiplier' => 0.5],
                    ],
                    [
                        'skill' => ['name' => 'Майстер обгонів', 'ppa' => 450],
                        'tier' => ['tier' => 1, 'multiplier' => 0.1],
                        'trait' => ['name' => 'Стаблільність', 'multiplier' => 0.5],
                    ],
                ],
            'bonuses' => [
                    ['name' => 'Дощику дощику', 'multiplier' => 0.5],
                    ['name' => 'Кращий за товариша по команді', 'multiplier' => 0.5],
                ]
        ];
        return view('fantasy.fantasy', [
            'title' => 'F1',
            'drivers' => $drivers,
            'team' => $team
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
        $races = [
            ['round' => 1, 'name' => 'Australia GP', 'country' => 'Australia', 'length' => 5.66, 'result' => [['place' => 1, 'driver' => 'Lando Norris'], ['place' => 2, 'driver' => 'Max Verstappen'], ['place' => 3, 'driver' => 'George Russel']]],
            ['round' => 2, 'name' => 'China GP', 'country' => 'China', 'length' => 4.79, 'result' => [['place' => 1, 'driver' => 'Oscar Piastri'], ['place' => 2, 'driver' => 'Max Verstappen'], ['place' => 3, 'driver' => 'Lando Norris']]]
        ];
        return view('fantasy.races', [
            'title' => 'F1',
            'races' => $races
        ]);
    }
    public function leaderboard()
    {
        $leaderboard = [
            ['place' => 1, 'username' => 'smooth_operator228', 'points' => 39012,12],
            ['place' => 2, 'username' => 'lando12yo', 'points' => 29200,99],
            ['place' => 3, 'username' => 'lando12yo', 'points' => 29200,99],
            ['place' => 4, 'username' => 'lando12yo', 'points' => 29200,99],
        ];
        return view('fantasy.leaderboard', [
            'title' => 'Fantasy Leaderboard',
            'leaderboard' => $leaderboard
        ]);
    }
    public function skills()
    {
        //ppa = Points per Action
        $driver_skills = [
            ['name' => 'Майстер обгонів', 'ppa' => 450],
            ['name' => 'Найшвидший круг гонки', 'ppa' => 1500],
            ['name' => 'Позиція в гонці', 'ppa' => 100], //21 - pos = action
        ];
        $team_skills = [
            ['name' => 'Майстер обгонів', 'ppa' => 200],
            ['name' => 'Найшвидший круг гонки', 'ppa' => 600],
            ['name' => 'Позиція в гонці', 'ppa' => 50], //21 - pos = action
        ];
        $tiers = [
            ['tier' => 1, 'multiplier' => 0.1],
            ['tier' => 2, 'multiplier' => 0.3],
            ['tier' => 3, 'multiplier' => 0.7],
            ['tier' => 4, 'multiplier' => 1.3],
            ['tier' => 5, 'multiplier' => 2.0],
            ['tier' => 6, 'multiplier' => 3.0],
        ];
        $traits = [
            ['name' => 'Стаблільність', 'multiplier' => 0.5],
            ['name' => 'Жадібність', 'multiplier' => 0.9],
            ['name' => 'Універсальність', 'multiplier' => 0.3],
            ['name' => 'Унікальність', 'multiplier' => 0.7],
            ['name' => 'Домінація', 'multiplier' => 1.0],
        ];
        $bonuses = [
            ['name' => 'Дощику дощику', 'multiplier' => 0.5],
            ['name' => 'Кращий за товариша по команді', 'multiplier' => 0.5],
        ];
        return view('fantasy.skills', [
            'title' => 'F1',
            'driver_skills' => $driver_skills,
            'team_skills' => $team_skills,
            'bonuses' => $bonuses,
            'tiers' => $tiers,
            'traits' => $traits
        ]);
    }
}
