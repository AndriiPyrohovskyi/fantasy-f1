@props(['name', 'multiplier' => null])

<div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
    <h3 class="text-xl font-semibold text-gray-800">Назва: {{ $name }}</h3>
    <h3 class="text-xl font-semibold text-gray-800">Плюс до загального множника: {{ $multiplier }}</h3>
</div>

