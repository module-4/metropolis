<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Component;
use App\Models\Effect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Component>
 */
class ComponentFactory extends Factory
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
            'image_name' => 'placeholder.jpg',
            'category_id' => Category::factory()->create(),
        ];
    }

    public function withEffect(): self
    {
        return $this->afterCreating(function (Component $component) {
            $effect = Effect::factory()->create();

            $component->effects()->attach($effect, ['value' => fake()->randomFloat(min: -1, max: 1)]);
        });
    }
}
