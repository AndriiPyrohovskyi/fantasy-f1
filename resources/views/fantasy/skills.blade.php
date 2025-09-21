@extends('layouts.app')

@section('content')
<h3 class="">Список скілів команди:</h3>
@foreach ($team_skills as $team_skill)
    <x-skills-team-skill-card
        :name="$team_skill['name']"
        :ppa="$team_skill['ppa']"
    />
@endforeach
<h3 class="">Список скілів гонщика:</h3>
@foreach ($driver_skills as $driver_skill)
    <x-skills-driver-skill-card
        :name="$driver_skill['name']"
        :ppa="$driver_skill['ppa']"
    />
@endforeach
<h3 class="">Список тірів для скіллів:</h3>
@foreach ($tiers as $tier)
    <x-skills-tier-card
        :tier="$tier['tier']"
        :multiplier="$tier['multiplier']"
    />
@endforeach
<h3 class="">Список характеристик для скіллів:</h3>
@foreach ($traits as $trait)
    <x-skills-trait-card
        :name="$trait['name']"
        :multiplier="$trait['multiplier']"
    />
@endforeach
<h3 class="">Список бонусів для гонщиків та команд:</h3>
@foreach ($bonuses as $bonus)
    <x-skills-bonus-card
        :name="$bonus['name']"
        :multiplier="$bonus['multiplier']"
    />
@endforeach
@endsection
