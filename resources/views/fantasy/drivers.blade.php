@extends('layouts.app')

@section('content')
<p class="text-gray-600 mb-6">Choose your drivers for the fantasy team:</p>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($drivers as $driver)
        <x-driver-card
            :name="$driver['name']"
            :team="$driver['team']"
            :points="$driver['points']"
            :price="$driver['price']"
        />
    @endforeach
</div>
@endsection
