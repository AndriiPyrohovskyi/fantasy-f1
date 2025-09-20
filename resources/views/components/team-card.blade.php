@props(['name', 'drivers' => null])

<div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
    <h3 class="text-xl font-semibold text-gray-800">{{ $name }}</h3>
    <p class="text-gray-600">
        <strong>Гонщики:</strong>
        {{ implode(', ', array_column($drivers, 'name')) }}
    </p>
    <a href="#">Додати до своєї команди</a>
</div>
