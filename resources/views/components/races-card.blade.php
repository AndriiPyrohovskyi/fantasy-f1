@props(['round', 'name', 'country', 'length', 'result' => null])

<div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
    <h3 class="text-xl font-semibold text-gray-800">Гонка {{ $round }}</h3>
    <h3 class="text-xl font-semibold text-gray-800">{{ $name }}</h3>
    <h3 class="text-xl font-semibold text-gray-800">Країна: {{ $country }}</h3>
    <h3 class="text-xl font-semibold text-gray-800">Довжина: {{ $length }}</h3>
    {{-- <p class="text-gray-600"><strong>Результати: </strong> {{ $result }}</p> --}}
</div>
