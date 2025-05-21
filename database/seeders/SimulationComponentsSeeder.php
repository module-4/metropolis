<?php

namespace Database\Seeders;

use App\Models\Component;
use App\Models\Simulation;
use App\Models\SimulationComponent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SimulationComponentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($y = 0; $y < 3; $y++) {
            for ($x = 0; $x < 4; $x++) {
            SimulationComponent::create([
                'simulation_id' => 1,
                'component_id' => Component::inRandomOrder()->first()->id,
                'x' => $x,
                'y' => $y
            ]);
            }
        }
    }
}
