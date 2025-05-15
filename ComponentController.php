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

        return view('component-manager-view', compact('components', 'categories', 'effects'));
    }

    public function update(Request $request, $id)
    {
        $component = Component::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'image_url' => 'required',
            'category_id' => 'required|exists:categories,id',
            'effect_id' => 'required|exists:effects,id',
        ]);

        $component->update([

            'name' => $validated['name'],
            //todo: IMAGE_URL moet een geupload bestand zijn, waar image_url de lokale locatie is van het bestand
            'image_url' => $validated['image_url'],
            'category_id' => $validated['category_id'],
        ]);

        $component->effects()->sync([
            $validated['effect_id'] => ['value' => 0.0]
        ]);

        return redirect()->route('component-manager')->with('success', 'Component updated successfully.');
    }
}

