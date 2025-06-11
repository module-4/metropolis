<?php

namespace Database\Seeders;

use App\Models\Effect;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventEffectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            $effectsMap = [
                'Power Outage' => [
                    'Safety' => -3,
                    'Services' => -4,
                ],
                'Flood' => [
                    'Safety' => -4,
                    'Eco-Quality' => -5,
                    'Services' => -2,
                ],
                'Concert' => [
                    'Recreation' => 4,
                    'Safety' => -2,
                    'Eco-Quality' => -1,
                ],
                'Protest' => [
                    'Safety' => -3,
                    'Services' => -1,
                ],
                'Fire Drill' => [
                    'Safety' => 2,
                    'Services' => -1,
                ],
                'City Marathon' => [
                    'Recreation' => 3,
                    'Eco-Quality' => 1,
                    'Services' => -1,
                ],
                'Garbage Strike' => [
                    'Eco-Quality' => -5,
                    'Safety' => -1,
                ],
                'Vaccination Drive' => [
                    'Safety' => 4,
                    'Services' => 3,
                ],
            ];

            foreach ($effectsMap as $eventName => $effects) {
                $event = Event::firstWhere('name', $eventName);

                foreach ($effects as $effectName => $value) {
                    $effect = Effect::firstWhere('name', $effectName);

                    $event->effects()->attach($effect->id, ['value' => $value]);
                }
            }
        }
    }
}
