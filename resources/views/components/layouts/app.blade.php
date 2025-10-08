<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forest App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <a href="{{ route('dashboard') }}"
                    class="text-2xl font-bold text-green-600 hover:underline flex items-center gap-2">
                    🌲 Forest App
                </a>
            </div>

            <nav class="mt-6">
                <a href="{{ route('dashboard') }}"
                    class="block px-6 py-3 {{ request()->routeIs('dashboard') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    🏠 Dashboard
                </a>
                <a href="{{ route('trips.index') }}"
                    class="block px-6 py-3 {{ request()->routeIs('trips.index') || request()->routeIs('trips.show') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    🗺️ My Trips
                </a>
                <a href="{{ route('trips.create') }}"
                    class="block px-6 py-3 {{ request()->routeIs('trips.create') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    ➕ New Trip
                </a>
                <a href="{{ route('users.index') }}"
                    class="block px-6 py-3 {{ request()->routeIs('users.*') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    👥 Community
                </a>
            </nav>

            <div class="absolute bottom-0 w-64 p-6 border-t">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>

    <footer class="bg-gray-100 text-center py-4 text-sm text-gray-600 border-t mt-8">
        Thank you — Forest App 2025. All rights reserved. CODE University of Applied Sciences
    </footer>
</body>

</html>