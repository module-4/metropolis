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
        /**@var $sim Simulation */
        $sim = Simulation::factory()->withComponents()->create();
    }
}
