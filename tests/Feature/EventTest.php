
<?php

use App\Models\User;
use App\Models\Event;
use App\Models\Effect;
use function Pest\Laravel\{actingAs, get, post, put, delete};
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// Helper to act as an authenticated user
function actingAsUser(): User {
    $user = User::factory()->create();
    actingAs($user);
    return $user;
}

test('guests cannot access event routes', function () {
    $event = Event::factory()->create();

    $responses = [
        get(route('events.index')),
        get(route('events.create')),
        post(route('events.store'), []),
        get(route('events.edit', $event)),
        put(route('events.update', $event), []),
        delete(route('events.destroy', $event)),
    ];

    foreach ($responses as $response) {
        $response->assertRedirect(route('login'));
    }
});

test('authenticated user can view events index', function () {
    actingAsUser();

    $response = get(route('events.index'));

    $response->assertOk();
    $response->assertViewIs('events.index');
});

test('authenticated user can view create event form', function () {
    actingAsUser();

    $response = get(route('events.create'));

    $response->assertOk();
    $response->assertViewIs('events.create');
});

test('authenticated user can store a new event with valid data', function () {
    actingAsUser();

    $effects = Effect::factory()->count(2)->create();

    $response = post(route('events.store'), [
        'name' => 'New Event',
        'effects' => $effects->map(fn ($e) => ['id' => $e->id, 'value' => 50])->toArray(),
    ]);

    $response->assertRedirect(route('events.index'));
    $this->assertDatabaseHas('events', ['name' => 'New Event']);
    foreach ($effects as $effect) {
        $this->assertDatabaseHas('event_effects', [
            'effect_id' => $effect->id,
            'value' => 50,
        ]);
    }
});

test('store fails with invalid data', function () {
    actingAsUser();

    $response = post(route('events.store'), [
        'name' => '', // Required
        'effects' => 'not-an-array',
    ]);

    $response->assertSessionHasErrors(['name', 'effects']);
});

test('authenticated user can view edit form', function () {
    actingAsUser();

    $event = Event::factory()->create();

    $response = get(route('events.edit', $event));

    $response->assertOk();
    $response->assertViewIs('events.edit');
    $response->assertViewHas('event', $event);
});

test('authenticated user can update an event', function () {
    actingAsUser();

    $event = Event::factory()->create(['name' => 'Old Name']);
    $effects = Effect::factory()->count(2)->create();

    $response = put(route('events.update', $event), [
        'name' => 'Updated Event',
        'effects' => $effects->map(fn ($e) => ['id' => $e->id, 'value' => 42])->toArray(),
    ]);

    $response->assertRedirect(route('events.index'));
    $this->assertDatabaseHas('events', ['id' => $event->id, 'name' => 'Updated Event']);
    foreach ($effects as $effect) {
        $this->assertDatabaseHas('event_effects', [
            'event_id' => $event->id,
            'effect_id' => $effect->id,
            'value' => 42,
        ]);
    }
});

test('authenticated user can delete an event', function () {
    actingAsUser();

    $event = Event::factory()->create();

    $response = delete(route('events.destroy', $event));

    $response->assertRedirect(route('events.index'));
    $this->assertModelMissing($event);
});
