<?php

use App\Models\Component;
use App\Models\Simulation;
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

    $component = Component::where('name', 'Test Component')->first();
    expect($component->effects()->where('effect_id', $this->effect->id)->exists())->toBeTrue();
});

test('store a component without data', function () {
    actingAs($this->user);

    $response = post(route('component-manager'), []);

    $response->assertSessionHasErrors(['name', 'image', 'category', 'effects']);
});

//the edit page

test('edit form returns errors with invalid input', function () {
    actingAs($this->user);

    $component = Component::factory()->create([
        'name' => 'valid input',
        'category_id' => $this->category->id,
    ]);

    $response = post(route('components.update', $component), [
        '_method' => 'PATCH',
        'name' => '',
        'category_id' => '',
    ]);

    $response->assertSessionHasErrors(['name', 'category_id']);
});
test('user can see the edit component form', function () {
    actingAs($this->user);

    $component = Component::factory()->create([
        'name' => 'Editable Component',
        'category_id' => $this->category->id,
        'image_name' => 'images/example.jpg',
    ]);

    $response = get(route('components.edit', $component));

    $response->assertStatus(200);
    $response->assertSee('Edit Component');
    $response->assertSee('Editable Component');
    $response->assertSee('value="Editable Component"', false); // input value
    $response->assertSee('name="name"', false);
    $response->assertSee('name="category_id"', false);
});
test('user can update a component', function () {
    actingAs($this->user);

    $component = Component::factory()->create([
        'name' => 'Old Name',
        'category_id' => $this->category->id,
    ]);

    $newImage = UploadedFile::fake()->image('updated.jpg');

    $response = post(route('components.update', $component), [
        '_method' => 'PATCH',
        'name' => 'Updated Name',
        'category_id' => $this->category->id,
        'image' => $newImage,
    ]);

    $response->assertRedirect(); // Adjust if you redirect somewhere specific
    $this->assertDatabaseHas('components', [
        'id' => $component->id,
        'name' => 'Updated Name',
    ]);

    Storage::disk('public')->assertExists('images/' . $newImage->hashName());
});


test('a component can be soft deleted', function () {
    $sim = Simulation::create([
        'alias' => 'Test Simulation',
    ]);
    $component = Component::factory()->create([
        'name' => 'Deletable Component',
        'category_id' => $this->category->id,
    ]);
    $sim->components()->attach($component->id, [
        'x' => 0,
        'y' => 0,
    ]);

    actingAs($this->user);
    $response = post(route('components.destroy', $component), [
        '_method' => 'DELETE',
    ]);

    $response->assertRedirect(route('component-manager'));
    $this->assertSoftDeleted('components', [
        'id' => $component->id,
        'name' => 'Deletable Component',
    ]);

    // Check if the component is still associated with the simulation
    $sim->refresh();
    $this->assertTrue($sim->components()->where('id', $component->id)->exists(), 'Component should still be associated with the simulation after soft delete.');
});
