<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Component;
use App\Models\Effect;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


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
        $validated = $request->validate([
            'name' => 'required|unique:components|max:255',
            'image' => 'required|image',
            'category' => 'required|exists:categories,id',
            'effects' => 'required|array',
            'effects.*.id' => 'required|exists:effects,id|distinct',
            'effects.*.value' => 'required|numeric',
        ]);


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $component = Component::create([
            'name' => $request->name,
            'image_name' => $imagePath,
            'category_id' => $request->category,
        ]);

        $effectsData = [];
        foreach ($validated['effects'] as $effect) {
            $effectsData[$effect['id']] = ['value' => $effect['value']];
        }

        $component->effects()->attach($effectsData);

        return redirect()->route('component-manager')->with('success', 'Component created successfully.');
    }

    public function edit(Component $component) {
        $categories = Category::all();
        $effects = Effect::all();
        $compEffects = $component->effects()->get();
        $simComponent = $component;

        return view('component-manager-edit', compact('simComponent', 'categories', 'effects', 'compEffects'));
    }

    public function update(Request $request, Component $component)
    {
        $validated = $request->validate([
            'name' => 'required|unique:components,name,'. $component->id .'|max:255',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $attributes = [
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $attributes['image_name'] = $imagePath;
        }

        $component->update($attributes);

        return redirect(route('component-manager'))->with('success', 'Component updated successfully.');
    }


}

