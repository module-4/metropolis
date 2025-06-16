<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Simulation;

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
}
