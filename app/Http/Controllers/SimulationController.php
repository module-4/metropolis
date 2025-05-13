<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Simulation;
use Illuminate\Http\Request;

class SimulationController extends Controller
{
    public function index()
    {
        // Get simulation by id 1, get the applied effects and components
        $simulation = Simulation::find(1);
        $effects = $simulation->getGridEffects();
        $simulationComponents = $simulation->components;

        // Get all available components, included with the categories
        $categories = Category::all();

        return view(
            'simulation',
            compact(
                'categories',
                'simulationComponents',
                'effects'
            )
        );
    }
}
