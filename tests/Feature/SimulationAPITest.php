<?php

use App\Models\Simulation;

test('checkEndpoint', function () {

    Simulation::factory()->create();

    $response = $this->put("/api/simulation/1/component");

    $response->assertStatus(200);
});
