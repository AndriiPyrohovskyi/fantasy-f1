@props(['driver'])

<div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-red-500">
    <h3 class="text-2xl font-bold text-gray-800 mb-4">🏎️ {{ $driver['name'] }}</h3>

    <!-- Skills Section -->
    <div class="mb-6">
        <h4 class="text-lg font-semibold text-gray-700 mb-3">⚡ Навички:</h4>
        @foreach($driver['skills'] as $skillData)
            <div class="bg-gray-50 rounded-lg p-4 mb-3 border">
                <!-- Skill Info -->
                <div class="mb-2">
                    <span class="font-medium text-blue-600">{{ $skillData['skill']['name'] }}</span>
                    <span class="text-sm text-gray-500 ml-2">({{ $skillData['skill']['ppa'] }} PPA)</span>
                </div>

                <!-- Tier Info -->
                <div class="mb-2">
                    <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm">
                        Тір {{ $skillData['tier']['tier'] }} (×{{ $skillData['tier']['multiplier'] }})
                    </span>
                </div>

                <!-- Trait Info -->
                <div>
                    <span class="inline-block bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm">
                        {{ $skillData['trait']['name'] }} (+{{ $skillData['trait']['multiplier'] }})
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Bonuses Section -->
    <div class="mb-4">
        <h4 class="text-lg font-semibold text-gray-700 mb-3">🎁 Бонуси:</h4>
        <div class="flex flex-wrap gap-2">
            @foreach($driver['bonuses'] as $bonus)
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                    {{ $bonus['name'] }} (+{{ $bonus['multiplier'] }})
                </span>
            @endforeach
        </div>
    </div>
</div>
