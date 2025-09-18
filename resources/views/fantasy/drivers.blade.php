@extends('layouts.app')

@section('content')
<p>Choose your drivers for the fantasy team:</p>

@foreach($drivers as $driver)
<div class="card driver">
    <h3>{{ $driver['name'] }}</h3>
    <p><strong>Team:</strong> {{ $driver['team'] }}</p>
    <p><strong>Points:</strong> {{ $driver['points'] }}</p>
    <p><strong>Price:</strong> ${{ $driver['price'] }}M</p>
</div>
@endforeach
@endsection
