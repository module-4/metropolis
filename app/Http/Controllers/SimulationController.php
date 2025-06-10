<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Simulation;
use Illuminate\Http\Request;

class SimulationController extends Controller
{
    public function index()
    {
        // Get simulation by id 1, get the applied effects and components
        $simulation = Simulation::firstOrCreate([], ["alias" => "simulation_1"]);
        $effects = $simulation->getGridEffects();
        $simulationComponents = $simulation->components;

        // Get all available components, included with the categories
        $categories = Category::all();
        $events = Event::with(['effects'])->get();
        return view(
            'simulation',
            compact(
                'categories',
                'simulationComponents',
                'effects',
                'events'
            )
        );
    }
}
