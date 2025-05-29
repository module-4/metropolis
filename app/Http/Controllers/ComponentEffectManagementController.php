<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\ComponentEffect;
use Illuminate\Http\Request;

class ComponentEffectManagementController extends Controller
{
    public function index() {
        $data = Component::with('effects')->paginate(6);
        return view('component-effect-management', compact('data'));
    }

    public function update($componentId, $effectId)
    {
        request()->validate([
            'effect-value' => ['required', 'numeric', 'min:-100000', 'max:100000']
        ]);

        // get the component that is related to that compId
        $component = Component::findOrFail($componentId);

        // update the pivot relationship
        $component->effects()->updateExistingPivot($effectId, [
            'value' => request('effect-value')
        ]);
        // redirect with success
        return back()->with('success', 'Effect value updated successfully');
    }
}
