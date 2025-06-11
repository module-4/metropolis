<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Event;
use App\Models\Effect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
        ];
    }

    public function withEffect(): self
    {
        return $this->afterCreating(function (Event $event) {
            $effect = Effect::factory()->create();

            $event->effects()->attach($effect, ['value' => fake()->randomFloat(min: -1, max: 1)]);
        });
    }
}
