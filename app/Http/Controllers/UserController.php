<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('trips')
            ->orderBy('name')
            ->get();
        
        return view('users.index', compact('users'));
    }
    
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        $trips = $user->trips()
            ->whereNotNull('end_time')
            ->with('voiceSession', 'comments')
            ->latest()
            ->paginate(10);
        
        $stats = [
            'total_trips' => $user->trips()->count(),
            'completed_trips' => $user->trips()->whereNotNull('end_time')->count(),
            'total_minutes' => $user->trips()->sum('duration') / 60,
            'average_satisfaction' => $user->trips()
                ->whereNotNull('satisfaction')
                ->avg('satisfaction'),
        ];
        
        return view('users.show', compact('user', 'trips', 'stats'));
    }
}
