<?php

namespace Database\Seeders;

use App\Models\Component;
use App\Models\ComponentEffect;
use App\Models\Effect;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentEffectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $minEffectValue = 1;
        $maxEffectValue = 50;

        // Police Station
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Police Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Police Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);

        // Fire Station
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Fire Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Fire Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Fire Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Environmental Quality')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);

        // Park
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Park')->id,
            'effect_id' => Effect::firstWhere('name', 'Recreation')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Park')->id,
            'effect_id' => Effect::firstWhere('name', 'Environmental Quality')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);

        // Cinema
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Cinema')->id,
            'effect_id' => Effect::firstWhere('name', 'Recreation')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Cinema')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);

        // Sports Park
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Sports Park')->id,
            'effect_id' => Effect::firstWhere('name', 'Recreation')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Sports Park')->id,
            'effect_id' => Effect::firstWhere('name', 'Environmental Quality')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Sports Park')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);

        // Water Treatment
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Water Treatment')->id,
            'effect_id' => Effect::firstWhere('name', 'Environmental Quality')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Water Treatment')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);

        // School
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'School')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'School')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);

        // Store
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Store')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Store')->id,
            'effect_id' => Effect::firstWhere('name', 'Recreation')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);

        // Hospital
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Hospital')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Hospital')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Hospital')->id,
            'effect_id' => Effect::firstWhere('name', 'Environmental Quality')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);

        // Train Station
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Train Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Mobility')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Train Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);

        // Road
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Road')->id,
            'effect_id' => Effect::firstWhere('name', 'Mobility')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Road')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Road')->id,
            'effect_id' => Effect::firstWhere('name', 'Environmental Quality')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);

        // Bicycle Path
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Bicycle Path')->id,
            'effect_id' => Effect::firstWhere('name', 'Mobility')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Bicycle Path')->id,
            'effect_id' => Effect::firstWhere('name', 'Recreation')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Bicycle Path')->id,
            'effect_id' => Effect::firstWhere('name', 'Environmental Quality')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);

        // Gas Station
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Gas Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Mobility')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Gas Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => fake()->numberBetween($minEffectValue, $maxEffectValue),
        ]);
    }
}
