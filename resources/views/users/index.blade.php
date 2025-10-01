<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold mb-6">Community</h1>
        
        <div class="
bg-white rounded-lg shadow overflow-hidden">
<table class="min-w-full divide-y divide-gray-200"><thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
Name
</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
Email
</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
Total Trips
</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
Actions
</th></tr></thead><tbody class="bg-white divide-y divide-gray-200">
@foreach($users as $user)
<tr><td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-gray-900">
{{ $user->name }}
@if($user->isAdmin())
<span class="ml-2 px-2 py-1 text-xs bg-purple-100 text-purple-800 rounded">Admin</span>
@endif
</div></td><td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-500">{{ $user->email }}</div></td><td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-900">{{ $user->trips_count }}</div></td><td class="px-6 py-4 whitespace-nowrap text-sm"><a href="{{ route('users.show', $user->id) }}" 
                                class="text-blue-600 hover:underline">
View Profile
</a></td></tr>
@endforeach
</tbody></table></div></div>
</x-layouts.app>