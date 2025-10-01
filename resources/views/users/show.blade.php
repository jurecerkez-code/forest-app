<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold">{{ $user->name }}'s Profile</h1>
            @if($user->isAdmin())
                <span class="px-3 py-1 text-sm bg-purple-100 text-purple-800 rounded">Admin</span>
            @endif
        </div>
        
        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Total Trips</p>
                <p class="text-3xl font-bold text-green-600">{{ $stats['total_trips'] }}</p>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Completed</p>
                <p class="text-3xl font-bold text-blue-600">{{ $stats['completed_trips'] }}</p>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Total Minutes</p>
                <p class="text-3xl font-bold text-purple-600">{{ number_format($stats['total_minutes'], 0) }}</p>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm">Avg Satisfaction</p>
                <p class="text-3xl font-bold text-yellow-600">
                    {{ $stats['average_satisfaction'] ? number_format($stats['average_satisfaction'], 1) : 'N/A' }}
                    @if($stats['average_satisfaction'])
                        <span class="text-sm">⭐</span>
                    @endif
                </p>
            </div>
        </div>
        
        <!-- Recent Trips -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Recent Trips</h2>
            
            @if($trips->isEmpty())
                <p class="text-gray-600">No completed trips yet.</p>
            @else
                <div class="space-y-4">
                    @foreach($trips as $trip)
                        <div class="border-b pb-4 last:border-b-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-medium">{{ basename($trip->audio_file, '.mp3') }}</p>
                                    <p class="text-sm text-gray-600">
                                        {{ $trip->start_time->format('M d, Y - h:i A') }}
                                    </p>
                                    @if($trip->satisfaction)
                                        <p class="text-sm">{{ str_repeat('⭐', $trip->satisfaction) }}</p>
                                    @endif
                                    @if($trip->comments_count > 0)
                                        <p class="text-sm text-gray-500">{{ $trip->comments_count }} comments</p>
                                    @endif
                                </div>
                                <span class="text-sm text-gray-500">
                                    {{ gmdate('i:s', $trip->duration) }} min
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    {{ $trips->links() }}
                </div>
            @endif
        </div>
        
        <div class="mt-6">
            <a href="{{ route('users.index') }}" class="text-blue-600 hover:underline">
                ← Back to community
            </a>
        </div>
    </div>
</x-layouts.app>