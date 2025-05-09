<?php

namespace Database\Factories;

use App\Models\Component;
use App\Models\Simulation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Simulation>
 */
class SimulationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alias' => $this->faker->unique()->word(),
        ];
    }

    /**
     * Creates components for each position.
     * */
    public function withComponents(): self
    {
        return $this->afterCreating(function (Simulation $simulation) {
            for ($y = 0; $y < 3; $y++) {
                for ($x = 0; $x < 4; $x++) {
                    $component = Component::factory()->withEffect()->create();
                    $simulation->components()->attach($component, [
                        'x' => $x,
                        'y' => $y
                    ]);
                }
            }
        });
    }
}
