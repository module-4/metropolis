<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Simulation;
use App\Models\Comment;

class CommentController extends Controller
{
    function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();
        $simulation = Simulation::findOrFail($validated['simulation_id']);
        $simulation->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
    public function destroy(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }

        $comment->delete();
        return back()->with('success', 'Comment deleted.');
    }
}

