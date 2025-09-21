@extends('layouts.app')

@section('content')
<p class="text-gray-600 mb-6">Choose your drivers for the fantasy team:</p>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($races as $race)
        <x-races-card
            :round="$race['round']"
            :name="$race['name']"
            :country="$race['country']"
            :length="$race['length']"
            :result="$race['result']"
        />
    @endforeach
</div>
@endsection
