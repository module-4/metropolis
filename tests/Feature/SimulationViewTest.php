<?php

use App\Models\User;

test('Simulation view available when authenticated', function () {
    $this->actingAs(User::factory()->create());
    $response = $this->get('/simulation');

    $response->assertStatus(200);
});

test('Simulation view available when NOT authenticated', function () {
    $response = $this->get('/simulation');

    $response->assertStatus(302);
});
