@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Drivers Section -->
    <div>
        <h2 class="text-2xl font-bold mb-4">Ваші гонщики</h2>
        @foreach($drivers as $driver)
            <x-fantasy-driver-card :driver="$driver" />
        @endforeach
    </div>

    <!-- Team Section -->
    <div>
        <h2 class="text-2xl font-bold mb-4">Ваша команда</h2>
        <x-fantasy-team-card :team="$team" />
    </div>
</div>
@endsection
