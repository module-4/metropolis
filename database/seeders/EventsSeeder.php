<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            $events = [
                'Power Outage',
                'Flood',
                'Concert',
                'Protest',
                'Fire Drill',
                'City Marathon',
                'Garbage Strike',
                'Vaccination Drive',
            ];

            foreach ($events as $eventName) {
                Event::create(['name' => $eventName]);
            }
        }
    }
}
