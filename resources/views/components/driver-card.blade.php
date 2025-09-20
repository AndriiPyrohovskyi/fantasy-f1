@props(['name', 'team', 'points', 'price' => null])

<div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
    <h3 class="text-xl font-semibold text-gray-800">{{ $name }}</h3>
    <p class="text-gray-600"><strong>Team:</strong> {{ $team }}</p>
    <p class="text-gray-600"><strong>Points:</strong> {{ $points }}</p>
    @if($price)
        <p class="text-green-600 font-bold">${{ $price }}M</p>
    @endif
</div>
