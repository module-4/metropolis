<?php

namespace Database\Seeders;

use App\Models\Effect;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,

            CategoriesSeeder::class,
            ComponentSeeder::class,
            EffectsSeeder::class,
            EventsSeeder::class,
            EventEffectSeeder::class,
            ComponentEffectSeeder::class,
            SimulationSeeder::class,
            // Not needed, this seeder fills the grid
            //SimulationComponentsSeeder::class,
        ]);
    }
}
