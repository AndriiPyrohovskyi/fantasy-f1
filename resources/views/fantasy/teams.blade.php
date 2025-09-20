@extends('layouts.app')

@section('content')
<p>F1 Constructor Teams:</p>
@foreach ($teams as $team)
<x-team-card
    :name="$team['name']"
    :drivers="$team['drivers']"
/>
@endforeach
@endsection
