<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentEffectManagementController extends Controller
{
    public function index() {
        return view('component-effect-management');
    }
}
