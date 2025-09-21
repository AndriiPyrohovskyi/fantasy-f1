@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Fantasy Leaderboard</h2>
    <p>Top fantasy teams will be displayed here.</p>
    @foreach ($leaderboard as $user)
        <x-leaderboard-card
            :place="$user['place']"
            :username="$user['username']"
            :points="$user['points']"
        />
    @endforeach
</div>
@endsection
