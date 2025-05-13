<?php

use App\Models\ComponentEffect;
use App\Models\Effect;
use App\Models\Simulation;
use App\Models\User;
use App\Models\Component;

test('the application returns the index page successfully', function () {
    $this->actingAs(User::factory()->create());
    $response = $this->get('/component-effect-management');

    $response->assertStatus(200);
});

test('the application fails returns the index page if not logged in', function () {
    $response = $this->get('/component-effect-management');

    $response->assertStatus(302);
});

test('the application updates the component effect successfully', function () {
    // for auth
    $user = User::factory()->create();
    $this->actingAs($user);

    // seed DB
    $sim = Simulation::factory()->withComponents()->create();

    // Grabs first component and effect
    $component = Component::find(1);
    $effect = Effect::find(1);
    $newValue = 10;

    // get initial value of the component effect from DB
    $initialValue = ComponentEffect::where('component_id', $component->id)
        ->where('effect_id', $effect->id)
        ->value('value');

    // Make the PATCH request
    $response = $this->patch(route('component-effect-management-update', [
        'componentId' => $component->id,
        'effectId' => $effect->id,
    ]), [
        'effect-value' => $newValue,
    ]);

    // Assert the response has a successful status code
    $response->assertStatus(302);
    // This fails bc it redirects to / instead of index route
    $response->assertRedirect(route('component-effect-management'));

    // get updated value from DB
    $updatedValue = ComponentEffect::where('component_id', $component->id)
        ->where('effect_id', $effect->id)
        ->value('value');

    // works
    $this->assertNotEquals($initialValue, $updatedValue);
    // works
    $this->assertEquals($newValue, $updatedValue);
});
