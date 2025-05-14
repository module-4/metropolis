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

}
