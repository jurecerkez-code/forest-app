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
        // Get available audio files from public/audio directory
        $audioFiles = [
            'meditation_nature.mp3' => 'Nature Meditation (10 min)',
            'meditation_breathing.mp3' => 'Breathing Exercise (10 min)',
            'meditation_mindfulness.mp3' => 'Mindfulness Walk (10 min)',
            'meditation_forest.mp3' => 'Forest Therapy (10 min)',
        ];
        
        return view('trips.create', compact('audioFiles'));
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
    
    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        
        // Check access rights
        if (!$trip->canEditOrDelete(auth()->user())) {
            return redirect()->route('trips.show', $trip->id)
                ->with('error', 'You do not have permission to edit this trip.');
        }
        
        $audioFiles = [
            'meditation_nature.mp3' => 'Nature Meditation (10 min)',
            'meditation_breathing.mp3' => 'Breathing Exercise (10 min)',
            'meditation_mindfulness.mp3' => 'Mindfulness Walk (10 min)',
            'meditation_forest.mp3' => 'Forest Therapy (10 min)',
        ];
        
        return view('trips.edit', compact('trip', 'audioFiles'));
    }
    
    public function update(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);
        
        // Check access rights
        if (!$trip->canEditOrDelete(auth()->user())) {
            abort(403);
        }
        
        $request->validate([
            'audio_file' => 'required|string',
            'satisfaction' => 'nullable|integer|min:1|max:5',
        ]);
        
        $trip->update([
            'audio_file' => $request->audio_file,
            'satisfaction' => $request->satisfaction,
        ]);
        
        // Update voice session
        if ($trip->voiceSession) {
            $trip->voiceSession->update([
                'audio_file' => $request->audio_file,
            ]);
        }
        
        return redirect()->route('trips.show', $trip->id)
            ->with('success', 'Trip updated successfully!');
    }
    
    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        
        // Check access rights
        if (!$trip->canEditOrDelete(auth()->user())) {
            abort(403);
        }
        
        $trip->delete();
        
        return redirect()->route('trips.index')
            ->with('success', 'Trip deleted successfully!');
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

        // Send notification
        $trip->user->notify(new \App\Notifications\TripCompletedNotification($trip));

        
        return redirect()->route('trips.show', $trip->id)
            ->with('success', 'Trip completed successfully!');
    }
}
