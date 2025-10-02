<x-layouts.app>
    <div class="max-w-3xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Start New Meditation Trip</h1>

        <form action="{{ route('trips.store') }}" method="POST">
            @csrf
            
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <label class="block text-sm font-medium mb-2">Select Meditation Session</label>
                <select name="audio_file" required class="w-full border rounded-lg p-2">
                    <option value="">Choose a session...</option>
                    <option value="meditation_forest">Forest Sounds - 10 min</option>
                    <option value="meditation_nature">Nature Sounds - 10 min</option>
                    <option value="meditation_breathing">Breathing - 10 min</option>
                    <option value="meditation_mindfulness">Mindfulness - 10 min</option>
                </select>
                @error('audio_file')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg">Start Trip</button>
            <a href="{{ route('trips.index') }}" class="bg-gray-200 px-6 py-3 rounded-lg ml-4">Cancel</a>
        </form>
    </div>
</x-layouts.app>