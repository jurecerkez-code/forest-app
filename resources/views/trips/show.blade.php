<x-layouts.app>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Trip Details</h1>
            
            @if($trip->canEditOrDelete(auth()->user()))
                <div class="flex gap-2">
                    <a href="{{ route('trips.edit', $trip->id) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                        Edit
                    </a>
                    <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this trip?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>
        
        <!-- Audio Player -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Meditation Session</h2>
            
            <div class="mb-4">
                <p class="font-medium text-lg mb-2">{{ basename($trip->audio_file, '.mp3') }}</p>
                <audio controls class="w-full">
                    <source src="{{ asset('audio/' . $trip->audio_file) }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Session Information</h2>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Started</p>
                    <p class="font-medium">{{ $trip->start_time->format('F d, Y - h:i A') }}</p>
                </div>
                
                @if($trip->end_time)
                    <div>
                        <p class="text-sm text-gray-600">Completed</p>
                        <p class="font-medium">{{ $trip->end_time->format('F d, Y - h:i A') }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600">Duration</p>
                        <p class="font-medium">{{ gmdate('i:s', $trip->duration) }} minutes</p>
                    </div>
                @endif
                
                <div>
                    <p class="text-sm text-gray-600">Audio Session</p>
                    <p class="font-medium">{{ basename($trip->audio_file, '.mp3') }}</p>
                </div>
            </div>
            
            @if($trip->satisfaction)
                <div class="mt-4 pt-4 border-t">
                    <p class="text-sm text-gray-600">Your Rating</p>
                    <p class="text-2xl">{{ str_repeat('⭐', $trip->satisfaction) }}</p>
                </div>
            @else
                <div class="mt-6 pt-6 border-t">
                    <h3 class="font-semibold mb-3">Complete Your Trip</h3>
                    <form action="{{ route('trips.complete', $trip->id) }}" method="POST">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            How satisfied are you with this session?
                        </label>
                        <select name="satisfaction" 
                                class="w-full border-gray-300 rounded-lg shadow-sm mb-3"
                                required>
                            <option value="">Select rating...</option>
                            <option value="1">⭐ - Poor</option>
                            <option value="2">⭐⭐ - Fair</option>
                            <option value="3">⭐⭐⭐ - Good</option>
                            <option value="4">⭐⭐⭐⭐ - Very Good</option>
                            <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                        </select>
                        <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                            Complete Trip
                        </button>
                    </form>
                </div>
            @endif
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Comments</h2>
            
            @if($trip->comments->isEmpty())
                <p class="text-gray-600 mb-4">No comments yet. Share your thoughts!</p>
            @else
                <div class="space-y-4 mb-6">
                    @foreach($trip->comments as $comment)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <a href="{{ route('users.show', $comment->user->id) }}" 
                                       class="font-semibold text-sm text-blue-600 hover:underline">
                                        {{ $comment->user->name }}
                                    </a>
                                    <p class="text-gray-700 mt-1">{{ $comment->content }}</p>
                                </div>
                                <span class="text-xs text-gray-500">
                                    {{ $comment->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Add a comment
                </label>
                <textarea name="content" 
                          rows="3" 
                          class="w-full border-gray-300 rounded-lg shadow-sm mb-3"
                          placeholder="Share your experience..."
                          required></textarea>
                @error('content')
                    <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
                @enderror
                
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                    Add Comment
                </button>
            </form>
        </div>
        
        <div class="mt-6">
            <a href="{{ route('trips.index') }}" 
               class="text-blue-600 hover:underline">
                ← Back to all trips
            </a>
        </div>
    </div>
</x-layouts.app>
