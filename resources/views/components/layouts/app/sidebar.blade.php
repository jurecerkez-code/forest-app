<flux:sidebar.group>
    <flux:sidebar.item wire:navigate href="{{ route('dashboard') }}" :current="request()->routeIs('dashboard') || request()->routeIs('home')">
        <flux:icon.home variant="outline"/>
        Dashboard
    </flux:sidebar.item>
    
    <flux:sidebar.item wire:navigate href="{{ route('trips.index') }}" :current="request()->routeIs('trips.*')">
        <flux:icon.map variant="outline"/>
        My Trips
    </flux:sidebar.item>
    
    <flux:sidebar.item wire:navigate href="{{ route('trips.create') }}" :current="false">
        <flux:icon.plus variant="outline"/>
        New Trip
    </flux:sidebar.item>
    
    <flux:sidebar.item wire:navigate href="{{ route('users.index') }}" :current="request()->routeIs('users.*')">
        <flux:icon.users variant="outline"/>
        Community
    </flux:sidebar.item>
</flux:sidebar.group>
