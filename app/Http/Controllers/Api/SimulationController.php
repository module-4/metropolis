<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\Simulation;
use App\Models\SimulationComponent;
use Illuminate\Http\Request;


class SimulationController extends Controller
{
    public function getNeighbors(Simulation $simulation, Request $request)
    {

        $x = intval($request->input("x"));
        $y = intval($request->input("y"));

        $neighbors = [];

        $simulationComponent = SimulationComponent::find([$simulation->id, $x, $y]);

        if ($simulationComponent) {
            $neighbors = $simulationComponent->getNeighbors();
        }

        return $neighbors;
    }

    public function updateComponent(Simulation $simulation, Request $request)
    {
        $x = intval($request->input('x'));
        $y = intval($request->input('y'));

        if (($x >= 0 && $x <= 3) && ($y >= 0 && $y <= 2) && ($x != null && $y != null)) {
            $newComponentId = intval($request->input('componentId'));

            $currentSimulationComponent = SimulationComponent::find([$simulation->id, $x, $y]);

            if (!$currentSimulationComponent) {
                SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $newComponentId, "x" => $x, "y" => $y]);

            } else {
                $currentSimulationComponent->update(["component_id" => $newComponentId]);
                $currentSimulationComponent->save();
            }
        }

        return response($simulation->getGridEffects(), 200);
    }
}
