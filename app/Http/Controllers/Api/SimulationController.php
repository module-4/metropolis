<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\ComponentBlockList;
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


    public function toggleApprovedStatus(Simulation $simulation, Request $request) {
        try {
            $x = intval($request->input("x"));
            $y = intval($request->input("y"));


            if (!$simulation->inBounds($x, $y)) {
                throw new \Exception("Coordinates out of bounds");
            }

            $simulationComponent = SimulationComponent::find([$simulation->id, $x, $y]);
            $isApproved = $simulationComponent->approved;

           if ($isApproved) {
               $simulationComponent->approved = false;
               $simulationComponent->save();
               $isApproved = false;
           } else {
               $simulationComponent->approved = true;
               $simulationComponent->save();
               $isApproved = true;
           }

            return response(["data" => ["altered_data" => ['isApproved' => $isApproved]], 200]);

        } catch (\Exception $e) {
            return response(["error" => $e->getMessage()], 500);
        }
    }

    public function isBlocked(Simulation $simulation, Request $request)
    {

        $isBlocked = false;

        try {
            $componentId = intval($request->input("componentId"));
            $x = intval($request->input("x"));
            $y = intval($request->input("y"));


            if (!$simulation->inBounds($x, $y)) {
                throw new \Exception("Coordinates out of bounds");
            }

            if (!$componentId) {
                throw new \Exception("Component id is required");
            }

            $component = Component::find($componentId);

            if (!$component) {
                throw new \Exception("Component not found");
            }

            $simulationComponent = SimulationComponent::find([$simulation->id, $x, $y]);

            if ($simulationComponent) {
                throw new \Exception("Position already occupied");
            }
            $offsets = [[-1, 0], [1, 0], [0, -1], [0, 1]];

            $inBlockListComponents = [];

            $allAdjacent = [];

            foreach ($offsets as [$dx, $dy]) {
                $offsetX = $x + $dx;
                $offsetY = $y + $dy;

                $adjacent = SimulationComponent::find([
                    $simulation->id,
                    $offsetX,
                    $offsetY
                ]);

                if (!$adjacent || !$adjacent->component) {
                    continue;
                }

                $allAdjacent[] = $adjacent;
                $adjacentBlocklist = $adjacent->component->blocks;


                if ($adjacentBlocklist->contains('id', $componentId) || $component->blocks->contains('id', $adjacent->component_id)) {
                    $inBlockListComponents[] = $adjacent->component;
                    $isBlocked = true;
                }
            }

            return response(["data" => ["isBlocked" => $isBlocked, "blocklist" => $inBlockListComponents]], 200);


        } catch (\Exception $e) {
            return response(["error" => $e->getMessage()], 500);
        }

    }
}
