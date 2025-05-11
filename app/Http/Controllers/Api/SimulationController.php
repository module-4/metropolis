<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\Simulation;
use App\Models\SimulationComponent;
use Illuminate\Http\Request;


class SimulationController extends Controller
{
    public function show(Simulation $simulation, $neighbors, $x, $y)
    {
        $simulationWithEffects = $simulation;

        return $simulationWithEffects;
    }

    public function updateComponent(Simulation $simulation, Request $request)
    {
        $x = intval($request->input('x'));
        $y = intval($request->input('y'));
        $newComponentId = intval($request->input('componentId'));

        $currentSimulationComponent = SimulationComponent::where(['x' => $x, 'y' => $y, "simulation_id" => $simulation->id])->first();

        if (!$currentSimulationComponent) {
            SimulationComponent::create([["component_id" => $newComponentId, "x" => $x, "y" => $y, "simulation_id" => $simulation->id]]);
        } else {
            $currentSimulationComponent["component_id"] = $newComponentId;
        }

        $totalSimulationEffects = $simulation->getGridEffects();

        return $totalSimulationEffects;

    }
}
