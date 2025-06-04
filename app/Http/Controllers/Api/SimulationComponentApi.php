<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\Simulation;
use App\Models\SimulationComponent;
use Illuminate\Http\Request;

class SimulationComponentApi extends Controller
{
    /**
     * Places a component of component type where id matches at the destination position in the simulation
     */
    public function store(Simulation $simulation, Request $request)
    {
        try {

            $x = intval($request->get('x'));
            $y = intval($request->get('y'));

            if (!$simulation->inBounds($x, $y)) {
                throw new \Exception("Coordinates out of bounds");
            }

            $componentId = intval($request->get('id'));
            $component = Component::find($componentId);

            if (!$component) {
                throw new \Exception('Simulation component not found');
            }

            try {
                SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $componentId, "x" => $x, "y" => $y]);
            } catch (\Exception $exception) {
                if ($exception->getCode() == 23000) {
                    throw new \Exception("Coordinates already occupied");
                } else {
                    throw new \Exception("Component couldn't be added to the simulation");
                }
            }

            return Response([
                "data" => ["effects" => $simulation->getGridEffects()],
            ], 200);

        } catch (\Exception $e) {
            return response(["error" => $e->getMessage()], 500);
        }

    }


    /**
     * Updates the position of the component found at the origin position to the destination position
     */
    public function update(Simulation $simulation, Request $request)
    {
        try {
            $originX = intval($request->get('originX'));
            $originY = intval($request->get('originY'));

            if (!$simulation->inBounds($originX, $originY)) {
                throw new \Exception("Origin coordinates out of bounds");
            }

            $destX = intval($request->get('destX'));
            $destY = intval($request->get('destY'));

            if (!$simulation->inBounds($destX, $destY)) {
                throw new \Exception("Destination coordinates out of bounds");
            }


            $component = SimulationComponent::find([$simulation->id, $originX, $originY]);

            if (!$component) {
                throw new \Exception('Simulation component not found');
            }

            if ($component->isApproved()) {
                throw new \Exception('Simulation component is approved, thus cant be modified');
            }

            try {
                \DB::table('simulation_components')
                    ->where('simulation_id', $simulation->id)
                    ->where('x', $originX)
                    ->where('y', $originY)
                    ->update([
                        'x' => $destX,
                        'y' => $destY,
                    ]);
            } catch (\Exception $exception) {
                if ($exception->getCode() == 23000) {
                    throw new \Exception("Coordinates already occupied");
                }else {
                    throw new \Exception("Component couldn't be added to the simulation");
                }
            }


            return Response([
                "data" => ["effects" => $simulation->getGridEffects(), "altered_data" => ["x" => $destX, "y" => $destY]],
            ], 200);

        } catch (\Exception $e) {
            return response(["error" => $e->getMessage()], 500);
        }

    }

    /**
     * Deletes a component from the simulation where the position matches
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

            if ($component->isApproved()) {
                throw new \Exception('Simulation component is approved, thus cant be deleted');
            }

            $res = $component->delete();

            if (!$res) {
                throw new \Exception('Simulation component failed to be deleted');
            }

            return Response([
                "data" => ["effects" => $simulation->getGridEffects()]
            ], 200);

        } catch (\Exception $e) {
            return response(["error" => $e->getMessage()], 500);
        }
    }
}
