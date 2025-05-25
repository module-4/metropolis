<?php

namespace Database\Seeders;

use App\Models\Effect;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EffectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $simEffects = ['Safety', 'Recreation', 'Eco-Quality', 'Services'];

        foreach ($simEffects as $effect) {
            Effect::create([
                'name' => $effect,
            ]);
        }
    }
}
