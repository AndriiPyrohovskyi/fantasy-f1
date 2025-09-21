@props(['place', 'username', 'points' => null])

<div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
    <h3 class="text-xl font-semibold text-gray-800">Місце: {{ $place }}</h3>
    <h3 class="text-xl font-semibold text-gray-800">Юзер: {{ $username }}</h3>
    <h3 class="text-xl font-semibold text-gray-800">Очки: {{ $points }}</h3>
</div>
