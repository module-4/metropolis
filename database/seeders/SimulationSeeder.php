<?php

namespace Database\Seeders;

use App\Models\Simulation;
use Illuminate\Database\Seeder;

class SimulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Simulation::create([
           "alias" => "Test Simulation",
       ]);
    }
}
