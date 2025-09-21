@props(['name', 'team' => null])

<div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
    <h3 class="text-xl font-semibold text-gray-800">{{ $name }}</h3>
    <p class="text-gray-600"><strong>Команда: </strong> {{ $team }}</p>
    <a href="#">Додати до своєї команди</a>
</div>
