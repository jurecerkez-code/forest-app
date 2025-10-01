<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
        
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Total Trips</p>
                <p class="text-3xl font-bold text-green-600">{{ $totalTrips }}</p>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Completed</p>
                <p class="text-3xl font-bold text-blue-600">{{ $completedTrips }}</p>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Total Minutes</p>
                <p class="text-3xl font-bold text-purple-600">{{ number_format($totalMinutes, 0) }}</p>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Avg Satisfaction</p>
                <p class="text-3xl font-bold text-yellow-600">
                    {{ $averageSatisfaction ? number_format($averageSatisfaction, 1) : 'N/A' }}
                    @if($averageSatisfaction)
                        <span class="text-sm">⭐</span>
                    @endif
                </p>
            </div>
        </div>
        
        <!-- Favorite Audio -->
        @if($favoriteAudio)
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <h2 class="text-xl font-semibold mb-2">Your Favorite Session</h2>
                <p class="text-gray-700">
                    {{ basename($favoriteAudio->audio_file, '.mp3') }}
                    <span class="text-sm text-gray-500">({{ $favoriteAudio->count }} times)</span>
                </p>
            </div>
        @endif
        
        <!-- Recent Trips -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Recent Trips</h2>
                <a href="{{ route('trips.index') }}" class="text-blue-600 hover:underline text-sm">
                    View all →
                </a>
            </div>
            
            @if($recentTrips->isEmpty())
                <p class="text-gray-600">No trips yet. <a href="{{ route('trips.create') }}" class="text-green-600 hover:underline">Start your first trip!</a></p>
            @else
                <div class="space-y-3">
                    @foreach($recentTrips as $trip)
                        <div class="border-b pb-3 last:border-b-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-medium">{{ basename($trip->audio_file, '.mp3') }}</p>
                                    <p class="text-sm text-gray-600">
                                        {{ $trip->start_time->format('M d, Y - h:i A') }}
                                    </p>
                                    @if($trip->satisfaction)
                                        <p class="text-sm">{{ str_repeat('⭐', $trip->satisfaction) }}</p>
                                    @endif
                                </div>
                                <a href="{{ route('trips.show', $trip->id) }}" class="text-blue-600 hover:underline text-sm">
                                    View →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        
        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('trips.create') }}" class="bg-green-600 hover:bg-green-700 text-white text-center py-4 rounded-lg font-semibold">
                Start New Trip
            </a>
            <a href="{{ route('trips.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-center py-4 rounded-lg font-semibold">
                View All Trips
            </a>
            <a href="{{ route('users.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white text-center py-4 rounded-lg font-semibold">
                Community
            </a>
        </div>
    </div>
</x-layouts.app>
