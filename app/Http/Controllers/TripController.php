<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\VoiceSession;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = auth()->user()->trips()
            ->with('voiceSession', 'comments')
            ->latest()
            ->get();
        
        return view('trips.index', compact('trips'));
    }
    
    public function create()
    {
        return view('trips.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'audio_file' => 'required|string',
        ]);
        
        $trip = Trip::create([
            'user_id' => auth()->id(),
            'start_time' => now(),
            'audio_file' => $request->audio_file,
        ]);
        
        VoiceSession::create([
            'trip_id' => $trip->id,
            'audio_file' => $request->audio_file,
            'duration' => 600,
        ]);
        
        return redirect()->route('trips.show', $trip->id);
    }
    
    public function show($id)
    {
        $trip = Trip::with('voiceSession', 'comments.user')
            ->findOrFail($id);
        
        if ($trip->user_id !== auth()->id()) {
            abort(403);
        }
        
        return view('trips.show', compact('trip'));
    }
    
    public function complete(Request $request, $id)
    {
        $request->validate([
            'satisfaction' => 'required|integer|min:1|max:5',
        ]);
        
        $trip = Trip::findOrFail($id);
        
        if ($trip->user_id !== auth()->id()) {
            abort(403);
        }
        
        $trip->update([
            'end_time' => now(),
            'duration' => now()->diffInSeconds($trip->start_time),
            'satisfaction' => $request->satisfaction,
        ]);
        
        return redirect()->route('trips.show', $trip->id)
            ->with('success', 'Trip completed successfully!');
    }
}