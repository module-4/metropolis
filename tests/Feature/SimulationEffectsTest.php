<?php

namespace Tests\Feature;

use App\Models\Component;
use App\Models\Effect;
use App\Models\Simulation;

//class SimulationEffectsTest extends TestCase
//{
//    use RefreshDatabase;

test('it_returns_effects_for_a_specific_position', function () {
    $simulation = Simulation::factory()->create();

    $effect = Effect::factory()->create(['name' => 'Leefbaarheid']);
    $component = Component::factory()->create();
    $component->effects()->attach($effect->id, ['value' => 1.5]);

    // Attach component to simulation at position 3
    $simulation->components()->attach($component->id, ['position' => 3]);

    $effects = $simulation->getPositionEffects(3);

    $this->assertNotNull($effects);
    $this->assertCount(1, $effects);
    $this->assertEquals('Leefbaarheid', $effects->first()->name);
    $this->assertEquals(1.5, $effects->first()->pivot->value);
});


test('it_sums_effects_across_all_components_in_simulation', function () {
    $simulation = Simulation::factory()->create();

    $livabilaty = Effect::factory()->create(['name' => 'Leefbaarheid']);
    $safety = Effect::factory()->create(['name' => 'Veiligheid']);

    $effect1 = $livabilaty;
    $effect2 = $livabilaty;
    $effect3 = $safety;

    $component1 = Component::factory()->create();
    $component2 = Component::factory()->create();

    $component1->effects()->attach([
        $effect1->id => ['value' => 2.0],
        $effect3->id => ['value' => 3.0],
    ]);

    $component2->effects()->attach([
        $effect2->id => ['value' => 1.5],
    ]);

    $simulation->components()->attach([
        $component1->id => ['position' => 1],
        $component2->id => ['position' => 2],
    ]);

    $summed = $simulation->getGridEffects();

    $this->assertArrayHasKey('Leefbaarheid', $summed);
    $this->assertArrayHasKey('Veiligheid', $summed);
    $this->assertEquals(3.5, $summed['Leefbaarheid']); // 2.0 + 1.5
    $this->assertEquals(3.0, $summed['Veiligheid']);
});
//}
