<flux:sidebar.group>
    <flux:sidebar.item wire:navigate href="{{ route('dashboard') }}"
        :current="request()->routeIs('dashboard') || request()->routeIs('home')">
        <flux:icon.home variant="outline" />
        Dashboard
    </flux:sidebar.item>

    <flux:sidebar.item wire:navigate href="{{ route('trips.index') }}" :current="request()->routeIs('trips.*')">
        <flux:icon.map variant="outline" />
        My Trips
    </flux:sidebar.item>

    <flux:sidebar.item wire:navigate href="{{ route('trips.create') }}" :current="false">
        <flux:icon.plus variant="outline" />
        New Trip
    </flux:sidebar.item>

    <flux:sidebar.item wire:navigate href="{{ route('users.index') }}" :current="request()->routeIs('users.*')">
        <flux:icon.users variant="outline" />
        Community
    </flux:sidebar.item>
</flux:sidebar.group>
@props(['title' => null])

<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxStyles
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <flux:brand href="{{ route('dashboard') }}" name="🌲 Forest App" class="px-2" />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" href="{{ route('dashboard') }}" :current="request()->routeIs('dashboard')">
                Dashboard
            </flux:navlist.item>

            <flux:navlist.item icon="map" href="{{ route('trips.index') }}"
                :current="request()->routeIs('trips.index') || request()->routeIs('trips.show')">
                My Trips
            </flux:navlist.item>

            <flux:navlist.item icon="plus" href="{{ route('trips.create') }}">
                New Trip
            </flux:navlist.item>

            <flux:navlist.item icon="user-group" href="{{ route('users.index') }}"
                :current="request()->routeIs('users.*')">
                Community
            </flux:navlist.item>
        </flux:navlist>

        <flux:spacer />

        <div class="flex flex-col items-center mb-4">
            @if(Auth::check())
                <div class="text-sm text-gray-700">
                    Logged in as <strong>{{ Auth::user()->name }}</strong>
                </div>
                <div class="text-xs text-gray-400">
                    {{ Auth::user()->email }}
                </div>
            @endif
        </div>




        <flux:navlist variant="outline">
            <flux:navlist.item icon="arrow-right-start-on-rectangle" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </flux:navlist.item>
        </flux:navlist>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </flux:sidebar>

    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <flux:spacer />
        <flux:profile avatar="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
            name="{{ auth()->user()->name }}" />
    </flux:header>

    <flux:main>
        {{ $slot }}
    </flux:main>

    @fluxScripts
</body>

</html>