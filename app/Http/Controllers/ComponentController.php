<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Component;
use App\Models\Effect;
use Illuminate\Http\Request;


class ComponentController extends Controller
{
    public function index()
    {
        $components = Component::with(['category', 'effects'])->get();
        $categories = Category::all();
        $effects = Effect::all();

        return view('component-manager', compact('components', 'categories', 'effects'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'category' => 'required|exists:categories,id',
            'effect.*.id' => 'required|exists:effects,id|string',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $component = Component::create([
            'name' => $request->name,
            'image_name' => $imagePath,
            'category_id' => $request->category,
        ]);

        $component->effects()->attach($request->effect, ['value' => 0.0]);

        return redirect()->route('component-manager')->with('success', 'Component created successfully.');
    }

    public function edit(Component $component) {
        $categories = Category::all();
        $effects = Effect::all();
        $simComponent = $component;

        return view('component-manager-edit', compact('simComponent', 'categories', 'effects'));
    }

    public function update(Request $request, Component $component)
    {


        $validated = $request->validate([
            'name' => 'required',
            'image_url' => 'required',
            'category_id' => 'required|exists:categories,id',
            'effect_id' => 'required|exists:effects,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $component->update([

            'name' => $validated['name'],
            //todo: IMAGE_URL moet een geupload bestand zijn, waar image_url de lokale locatie is van het bestand
            'image_url' => $imagePath,
            'category_id' => $validated['category_id'],
        ]);

        $component->effects()->sync([
            $validated['effect_id'] => ['value' => 0.0]
        ]);

        return redirect()->route('component-manager')->with('success', 'Component updated successfully.');
    }


}

