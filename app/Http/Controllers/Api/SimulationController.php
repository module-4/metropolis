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
        try {
            $x = intval($request->input("x"));
            $y = intval($request->input("y"));

            if (!$simulation->inBounds($x, $y)) {
                throw new \Exception("Coordinates out of bounds");
            }

            $neighbors = [];

            $simulationComponent = SimulationComponent::find([$simulation->id, $x, $y]);

            if ($simulationComponent) {
                $neighbors = $simulationComponent->getNeighbors();
            }

            return response(["data" => ["neighbors" => $neighbors]], 200);
        } catch (\Exception $e) {
            return response(["error" => $e->getMessage()], 500);
        }

    }

}
