<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get user statistics
        $totalTrips = $user->trips()->count();
        $completedTrips = $user->trips()->whereNotNull('end_time')->count();
        $totalMinutes = $user->trips()->sum('duration') / 60;
        $averageSatisfaction = $user->trips()
            ->whereNotNull('satisfaction')
            ->avg('satisfaction');
        
        // Get recent trips
        $recentTrips = $user->trips()
            ->with('voiceSession', 'comments')
            ->latest()
            ->take(5)
            ->get();
        
        // Get most used audio
        $favoriteAudio = $user->trips()
            ->select('audio_file', DB::raw('count(*) as count'))
            ->groupBy('audio_file')
            ->orderByDesc('count')
            ->first();
        
        // Get satisfaction trend (last 7 trips)
        $satisfactionTrend = $user->trips()
            ->whereNotNull('satisfaction')
            ->latest()
            ->take(7)
            ->pluck('satisfaction', 'start_time')
            ->reverse();
        
        return view('dashboard', compact(
            'totalTrips',
            'completedTrips',
            'totalMinutes',
            'averageSatisfaction',
            'recentTrips',
            'favoriteAudio',
            'satisfactionTrend'
        ));
    }
}
