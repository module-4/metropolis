<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Component;
use App\Models\Effect;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function index() {
        $components = Component::all();
        $effects = Effect::all();
        $categories = Category::all();

        return view('component-manager', ['components'=> $components, 'effects'=> $effects, 'categories' => $categories]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'image' => 'required|url',
            'category' => 'required|exists:categories,id',
            'effect' => 'required|exists:effects,id', // assuming a single effect
        ]);

        $component = Component::create([
            'name' => $request->name,
            'image_name' => $request->image,
            'category_id' => $request->category,
        ]);

        // Attach effect via pivot table
        $component->effects()->attach($request->effect, ['value' => 0.0]);

        return redirect()->route('component-manager')->with('success', 'Component created successfully.');
    }
}
