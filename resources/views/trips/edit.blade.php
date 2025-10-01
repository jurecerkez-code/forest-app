<x-layouts.app>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold mb-6">Edit Trip</h1>
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('trips.update', $trip->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Meditation Session
                    </label>
                    <select name="audio_file" 
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500"
                            required>
                        @foreach($audioFiles as $file => $label)
                            <option value="{{ $file }}" {{ $trip->audio_file === $file ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('audio_file')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                @if($trip->satisfaction)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Satisfaction Rating
                        </label>
                        <select name="satisfaction" 
                                class="w-full border-gray-300 rounded-lg shadow-sm">
                            <option value="">No rating</option>
                            <option value="1" {{ $trip->satisfaction === 1 ? 'selected' : '' }}>⭐ - Poor</option>
                            <option value="2" {{ $trip->satisfaction === 2 ? 'selected' : '' }}>⭐⭐ - Fair</option>
                            <option value="3" {{ $trip->satisfaction === 3 ? 'selected' : '' }}>⭐⭐⭐ - Good</option>
                            <option value="4" {{ $trip->satisfaction === 4 ? 'selected' : '' }}>⭐⭐⭐⭐ - Very Good</option>
                            <option value="5" {{ $trip->satisfaction === 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ - Excellent</option>
                        </select>
                    </div>
                @endif
                
                <div class="flex gap-4">
                    <button type="submit" 
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">
                        Update Trip
                    </button>
                    <a href="{{ route('trips.show', $trip->id) }}" 
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-lg">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
