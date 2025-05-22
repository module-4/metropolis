<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\{actingAs, get, post};

uses(RefreshDatabase::class);

beforeEach(function () {
    Storage::fake('public');

    $this->user = \App\Models\User::factory()->create([
        'name' => 'username',
        'password' => bcrypt('password'),
    ]);

    $this->category = \App\Models\Category::factory()->create();
    $this->effect = \App\Models\Effect::factory()->create();

    $this->image = UploadedFile::fake()->image('component.jpg');
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
        'image' => $this->image,
        'category' => $this->category->id,
        'effects' => [
            ['id' => $this->effect->id, 'value' => 2.5],
        ],
    ];

    $response = post(route('component-manager'), $data);

    $response->assertRedirect(route('component-manager'));
    $response->assertSessionHas('success', 'Component created successfully.');

    $this->assertDatabaseHas('components', [
        'name' => 'Test Component',
        'category_id' => $this->category->id,
    ]);

    Storage::disk('public')->assertExists('images/' . $this->image->hashName());

    $component = \App\Models\Component::where('name', 'Test Component')->first();
    expect($component->effects()->where('effect_id', $this->effect->id)->exists())->toBeTrue();
});

test('store a component without data', function () {
    actingAs($this->user);

    $response = post(route('component-manager'), []);

    $response->assertSessionHasErrors(['name', 'image', 'category', 'effects']);
});

