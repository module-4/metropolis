<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\ComponentBlockList;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ComponentBlockListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blocklist = ComponentBlockList::with(['component','blockedComponent'])->get();
        return view('blocklist.index', compact('blocklist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $components = Component::all();
        return view('blocklist.create', compact('components'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputA = (int) $request->input('component_id');
        $inputB = (int) $request->input('blocked_component_id');

        $component_id = min($inputA, $inputB);
        $blocked_component_id = max($inputA, $inputB);

        $request->merge([
            'component_id' => $component_id,
            'blocked_component_id' => $blocked_component_id,
        ]);

        $validated = $request->validate([
            'component_id' => ['required', 'exists:components,id'],
            'blocked_component_id' => [
                'required',
                'exists:components,id',
                Rule::unique('component_blocklist')->where(fn ($query) => $query
                    ->where('component_id', $component_id)
                    ->where('blocked_component_id', $blocked_component_id)
                ),
            ],
        ], [
            'component_id.exists' => 'The first component does not exist.',
            'blocked_component_id.exists' => 'The second component does not exist.',
            'blocked_component_id.unique' => 'This restriction already exists.',
        ]);

        //|unique:component_blocklist,blocked_component_id

        ComponentBlockList::create([
            'component_id' => $validated['component_id'],
            'blocked_component_id' => $validated['blocked_component_id']
        ]);

        return redirect()->route('blocklist.index')->with('success', 'Blocklist entry created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $blockedId)
    {
        ComponentBlockList::where([
            'component_id' => $id,
            'blocked_component_id' => $blockedId
        ])->delete();
        return redirect()->route('blocklist.index')->with('success', 'Blocklist entry deleted successfully');
    }
}
