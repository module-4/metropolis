<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\ComponentEffect;
use Illuminate\Http\Request;

class ComponentEffectManagementController extends Controller
{
    public function index() {
        $data = Component::with('effects')->get();
        return view('component-effect-management', compact('data'));
    }
}
