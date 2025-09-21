@props(['name', 'ppa' => null])

<div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
    <h3 class="text-xl font-semibold text-gray-800">Назва скіллу гонщика: {{ $name }}</h3>
    <h3 class="text-xl font-semibold text-gray-800">Очків за дію: {{ $ppa }}</h3>
</div>
