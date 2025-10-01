<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'content' => 'required|string|max:1000',
        ]);
        
        Comment::create([
            'trip_id' => $request->trip_id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
        
        return redirect()->route('trips.show', $request->trip_id)
            ->with('success', 'Comment added successfully!');
    }
}