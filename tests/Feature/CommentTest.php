<?php

use App\Models\Simulation;
use App\Models\User;

it('can create a comment', function () {
    $user = User::factory()->create();
    $simulation = Simulation::factory()->create();

    $this->actingAs($user)
        ->post(route('comments.store'), [
            'simulation_id' => $simulation->id,
            'content' => 'This is a test comment.',
        ])
        ->assertRedirect();
    $this->assertDatabaseHas('comments', [
        'simulation_id' => $simulation->id,
        'user_id' => $user->id,
        'content' => 'This is a test comment.',
    ]);
});

it('can not create a comment without content', function () {
    $user = User::factory()->create();
    $simulation = Simulation::factory()->create();

    $this->actingAs($user)
        ->post(route('comments.store'), [
            'simulation_id' => $simulation->id,
            'content' => '',
        ])
        ->assertSessionHasErrors('content');
});

it('can not create a comment without being authenticated', function () {
    $simulation = Simulation::factory()->create();

    $this->post(route('comments.store'), [
        'simulation_id' => $simulation->id,
        'content' => 'This is a test comment.',
    ])->assertRedirect(route('login'));
});
