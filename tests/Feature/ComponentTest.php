<?php

use function Pest\Laravel\{actingAs, get, post};
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = \App\Models\User::factory()->create([
        'name' => 'username',
        'password' => bcrypt('password'),
    ]);
    $this->category = \App\Models\Category::factory()->create();
    $this->effect = \App\Models\Effect::factory()->create();
});

test('Component routing', function () {
    actingAs($this->user);

    $response = get(route('component-manager'));

    $response->assertStatus(200);
    $response->assertViewIs('component-manager');
    $response->assertViewHasAll([
        'components',
        'effects',
        'categories',
    ]);
});

test('store a component', function () {
    actingAs($this->user);

    $data = [
        'name' => 'Test Component',
        'image' => 'https://example.com/image.png',
        'category' => $this->category->id,
        'effect' => $this->effect->id,
    ];

    $response = post(route('component-manager'), $data);

    $response->assertRedirect(route('component-manager'));
    $response->assertSessionHas('success', 'Component created successfully.');

    $this->assertDatabaseHas('components', [
        'name' => 'Test Component',
        'image_name' => 'https://example.com/image.png',
        'category_id' => $this->category->id,
    ]);

    $component = \App\Models\Component::where('name', 'Test Component')->first();
    expect($component->effects()->where('effect_id', $this->effect->id)->exists())->toBeTrue();
});

test('store a component without data', function () {
    actingAs($this->user);

    $response = post(route('component-manager'), []); // missing fields

    $response->assertSessionHasErrors(['name', 'image', 'category', 'effect']);
});
