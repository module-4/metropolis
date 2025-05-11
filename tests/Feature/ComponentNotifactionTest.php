<?php

use App\Events\ComponentCreated;
use App\Models\Component;

test('component creation triggers event', function () {
    Event::fake();

    $component = Component::factory()->create();

    Event::assertDispatched(ComponentCreated::class, function ($event) use ($component) {
        return $event->component->id === $component->id;
    });
});

test('component creation triggers notification creation', function () {
    $component = Component::factory()->create();

    $this->assertDatabaseHas('component_notifications', [
        'component_id' => $component->id,
    ]);
});
