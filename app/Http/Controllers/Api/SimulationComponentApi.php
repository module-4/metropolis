<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Simulation;
use App\Models\SimulationComponent;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\StringValue;

class SimulationComponentApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Simulation $simulation, Request $request)
    {

        return $simulation;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Simulation $simulation, Request $request)
    {
        //
        return $simulation;

    }

    /**
     * Display the specified resource.
     */
    public function show(Simulation $simulation, Request $request)
    {
        //

        return $simulation;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Simulation $simulation, Request $request)
    {
        return $simulation;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Simulation $simulation, Request $request)
    {
        try {
            $x = intval($request->get('x'));
            $y = intval($request->get('y'));

            if (!$simulation->inBounds($x, $y)) {
                throw new \Exception("Coordinates out of bounds");
            }

            $component = SimulationComponent::find([$simulation->id, $x, $y]);

            if (!$component) {
                throw new \Exception('Simulation component not found');
            }

            $res = $component->delete();

            if (!$res) {
                throw new \Exception('Simulation component failed to be deleted');
            }

            return Response([
                "data" => $simulation->getGridEffects(),
            ], 200);

        } catch (\Exception $e) {
            return response(["error" => $e->getMessage()], 500);
        }
    }
}
