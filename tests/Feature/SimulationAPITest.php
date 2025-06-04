<?php

use App\Models\Simulation;
use App\Models\SimulationComponent;
use App\Models\ComponentBlockList;
use App\Models\Component;


// /api/simulation/{simulationId}/neighbors?x=int&y=int
test('getNeighborsSingleNeighbor', function () {

    $simulation = Simulation::factory()->create();

    $component = Component::factory()->create();

    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0]);
    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 1, "y" => 0]);

    $res = $this->get("/api/simulation/" . $simulation->id . "/neighbors?x=0&y=0");

    $res->assertStatus(200);

    $res->assertJson(["data" => [
            "neighbors" => [
                0 => [
                    "id" => $component->id,
                    "x" => 1,
                    "y" => 0,
                    "effects" => []
                ]
            ]
        ]]

    );
});
test('getNeighborsMultipleNeighbors', function () {

    $simulation = Simulation::factory()->create();

    $component = Component::factory()->create();

    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0]);
    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 1, "y" => 0]);
    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 1]);
    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 1, "y" => 1]);

    $res = $this->get("/api/simulation/" . $simulation->id . "/neighbors?x=0&y=0");

    $res->assertStatus(200);

    $res->assertJsonCount(3, 'data.neighbors');
});
test("getNeighborsNoNeighbors", function () {
    $simulation = Simulation::factory()->create();
    $component = Component::factory()->create();

    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0]);
    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 4, "y" => 2]);

    $res = $this->get("/api/simulation/" . $simulation->id . "/neighbors?x=0&y=0");

    $res->assertStatus(200);
    $res->assertJsonCount(0, 'data.neighbors');
});

test("addComponentToSimulation", function () {

    $simulation = Simulation::factory()->create();
    $component = Component::factory()->create();

    $this->post("/api/simulation/" . $simulation->id . "/component?id=" . $component->id . "&x=10&y=10")->assertStatus(500);

    $res = $this->post("/api/simulation/" . $simulation->id . "/component?id=" . $component->id . "&x=0&y=0");

    $res->assertStatus(200);
    $res->assertJson(["data" => ["effects" => []]]);
    $this->assertDatabaseHas("simulation_components", ["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0]);
});

test("deleteComponentFromSimulationInBounds", function () {
    $simulation = Simulation::factory()->create();
    $component = Component::factory()->create();

    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0]);

    $this->assertDatabaseHas("simulation_components", ["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0]);

    $res = $this->delete("/api/simulation/" . $simulation->id . "/component?x=0&y=0");

    $res->assertStatus(200);
    $res->assertJson(["data" => ["effects" => []]]);
    $this->assertDatabaseEmpty("simulation_components");
});

test("deleteComponentFromSimulationOutOfBounds", function () {
    $simulation = Simulation::factory()->create();
    $component = Component::factory()->create();

    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0]);

    $this->assertDatabaseHas("simulation_components", ["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0]);

    $res = $this->delete("/api/simulation/" . $simulation->id . "/component?x=10&y=10");

    $res->assertStatus(500);
    $res->assertJson(["error" => "Coordinates out of bounds"]);
    $this->assertDatabaseHas("simulation_components", ["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0]);
});

test("updateComponentPositionInSimulation", function () {

    $simulation = Simulation::factory()->create();
    $component = Component::factory()->create();

    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0]);

    $this->assertDatabaseHas("simulation_components", ["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0]);

    $this->patch("/api/simulation/" . $simulation->id . "/component?originX=0&originY=0&destX=10&destY=10")->assertStatus(500);

    $res = $this->patch("/api/simulation/" . $simulation->id . "/component?originX=0&originY=0&destX=1&destY=1");

    $res->assertStatus(200);
    $res->assertJson(["data" => ["altered_data" => ["x" => 1, "y" => 1], "effects" => []]]);
    $this->assertDatabaseHas("simulation_components", ["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 1, "y" => 1]);
});

test("validatePositionInSimulation",function (){
    $simulation = Simulation::factory()->create();
    $component = Component::factory()->create();
    $blockedComponent = Component::factory()->create();

    ComponentBlockList::create(["component_id" => $component->id, "blocked_component_id" => $blockedComponent->id]);

    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0]);
    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 1, "y" => 0]);
    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 2, "y" => 0]);
    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $blockedComponent->id, "x" => 0, "y" => 3]);


    $resWithMissingParameters = $this->get("/api/simulation/" . $simulation->id . "/isblocked");
    $resWithMissingParameters->assertStatus(500);

    $resOutOfBounds = $this->get("/api/simulation/" . $simulation->id . "/isblocked?componentId=" . $component->id . "&x=100&y=100");

    $resOutOfBounds->assertStatus(500);

    $res = $this->get("/api/simulation/" . $simulation->id . "/isblocked?componentId=".$blockedComponent->id."&x=1&y=1");
    $res->assertStatus(200);
    $res->assertJson(["data" => ["isBlocked" => true,"blocklist"=>[]]]);


    $resOtherWay = $this->get("/api/simulation/" . $simulation->id . "/isblocked?componentId=".$component->id."&x=0&y=2");
    $resOtherWay->assertStatus(200);
    $resOtherWay->assertJson(["data" => ["isBlocked" => true,"blocklist"=>[]]]);

});

// Approval

test("New Component on grid is not approved", function () {

    $simulation = Simulation::factory()->create();
    $component = Component::factory()->create();
    $res = $this->post("/api/simulation/" . $simulation->id . "/component?id=" . $component->id . "&x=0&y=0");

    $res->assertStatus(200);
    $res->assertJson(["data" => ["effects" => []]]);
    $this->assertDatabaseHas("simulation_components", ["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0, "approved" => false]);
});

test("Component approval toggle works", function () {

    $simulation = Simulation::factory()->create();
    $component = Component::factory()->create();

    SimulationComponent::create(["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0]);

    $resApprove = $this->get("/api/simulation/" . $simulation->id . "/toggle-approved-status?x=0&y=0");

    $resApprove->assertStatus(200);
    $this->assertDatabaseHas("simulation_components", ["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0, "approved" => true]);

    $resNoApprove = $this->get("/api/simulation/" . $simulation->id . "/toggle-approved-status?x=0&y=0");

    $resNoApprove->assertStatus(200);
    $this->assertDatabaseHas("simulation_components", ["simulation_id" => $simulation->id, "component_id" => $component->id, "x" => 0, "y" => 0, "approved" => false]);
});

test("Approved Component cannot be moved", function () {

    $simulation = Simulation::factory()->create();
    $component = Component::factory()->create();

    $simulation->components()->attach($component->id, ['x' => 0, 'y' => 0, 'approved' => true]);

    // I like to move it, move it. I like to move it, move it. MOVE IT!
    $resMoveIt = $this->patch("/api/simulation/" . $simulation->id . "/component?originX=0&originY=0&destX=1&destY=1");
    $resMoveIt->assertStatus(500);
});

test("Approved Component cannot be deleted", function () {

    $simulation = Simulation::factory()->create();
    $component = Component::factory()->create();

    $simulation->components()->attach($component->id, ['x' => 0, 'y' => 0, 'approved' => true]);

    $res = $this->delete("/api/simulation/" . $simulation->id . "/component?x=0&y=0");
    $res->assertStatus(500);
});

