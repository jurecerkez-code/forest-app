<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Trip;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'content' => 'required|string|max:1000',
        ]);
        
        $comment = Comment::create([
            'trip_id' => $request->trip_id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
        
        // Send notification to trip owner (if not commenting on own trip)
        $trip = Trip::find($request->trip_id);
        if ($trip->user_id !== auth()->id()) {
            $trip->user->notify(new \App\Notifications\NewCommentNotification($comment));
        }
        
        return redirect()->route('trips.show', $request->trip_id)
            ->with('success', 'Comment added successfully!');
    }
}
