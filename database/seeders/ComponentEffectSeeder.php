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

        // Police Station
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Police Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => 5,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Police Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Recreation')->id,
            'value' => 1,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Police Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => 1,
        ]);

        // Fire Station
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Fire Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => 4,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Fire Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Recreation')->id,
            'value' => 1,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Fire Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Eco-Quality')->id,
            'value' => 2,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Fire Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => 1,
        ]);

        // Park
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Park')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => -2,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Park')->id,
            'effect_id' => Effect::firstWhere('name', 'Recreation')->id,
            'value' => 5,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Park')->id,
            'effect_id' => Effect::firstWhere('name', 'Eco-Quality')->id,
            'value' => 4,
        ]);

        // Cinema
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Cinema')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => -1,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Cinema')->id,
            'effect_id' => Effect::firstWhere('name', 'Recreation')->id,
            'value' => 4,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Cinema')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => 2,
        ]);

        // Sports Park
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Sports Park')->id,
            'effect_id' => Effect::firstWhere('name', 'Recreation')->id,
            'value' => 5,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Sports Park')->id,
            'effect_id' => Effect::firstWhere('name', 'Eco-Quality')->id,
            'value' => 2,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Sports Park')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => 3,
        ]);

        // Water Treatment
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Water Treatment')->id,
            'effect_id' => Effect::firstWhere('name', 'Eco-Quality')->id,
            'value' => 5,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Water Treatment')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => 2,
        ]);

        // School
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'School')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => 2,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'School')->id,
            'effect_id' => Effect::firstWhere('name', 'Recreation')->id,
            'value' => 2,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'School')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => 5,
        ]);

        // Store
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Store')->id,
            'effect_id' => Effect::firstWhere('name', 'Eco-Quality')->id,
            'value' => -2,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Store')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => 5,
        ]);

        // Hospital
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Hospital')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => 3,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Hospital')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => 5,
        ]);

        // Train Station
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Train Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => -2,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Train Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Recreation')->id,
            'value' => 2,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Train Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => 4,
        ]);

        // Road
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Road')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => -4,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Road')->id,
            'effect_id' => Effect::firstWhere('name', 'Recreation')->id,
            'value' => 2,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Road')->id,
            'effect_id' => Effect::firstWhere('name', 'Eco-Quality')->id,
            'value' => -4,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Road')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => 3,
        ]);

        // Bicycle Path
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Bicycle Path')->id,
            'effect_id' => Effect::firstWhere('name', 'Recreation')->id,
            'value' => 3,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Bicycle Path')->id,
            'effect_id' => Effect::firstWhere('name', 'Eco-Quality')->id,
            'value' => 3,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Bicycle Path')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => 3,
        ]);

        // Gas Station
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Gas Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Safety')->id,
            'value' => -2,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Gas Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Eco-Quality')->id,
            'value' => -4,
        ]);
        ComponentEffect::create([
            'component_id' => Component::firstWhere('name', 'Gas Station')->id,
            'effect_id' => Effect::firstWhere('name', 'Services')->id,
            'value' => 1,
        ]);
    }
}
