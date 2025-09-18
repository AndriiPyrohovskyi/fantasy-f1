@extends('layouts.app')

@section('content')
<p>F1 Constructor Teams:</p>

@if(count($teams) > 0)
    @foreach($teams as $team)
    <div class="card team">
        <h3>{{ $team['name'] }}</h3>
        <p><strong>Points:</strong> {{ $team['points'] }}</p>
        <p><strong>Budget:</strong> ${{ $team['budget'] }}M</p>
    </div>
    @endforeach
@else
    <div class="card">
        <p>No teams data available yet. Coming soon!</p>
    </div>
@endif
@endsection
