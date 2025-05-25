<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Component;
use App\Models\ComponentEffect;
use App\Models\Effect;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // Component Seeder
    public function run(): void
    {
        // Safety Components
        Component::create([
            'name' => 'Police Station',
            'image_name' => "https://em-content.zobj.net/source/microsoft-3D-fluent/406/police-car_1f693.png",
            'category_id' => Category::firstWhere('name', 'Safety')->id,
        ]);

        Component::create([
            'name' => 'Fire Station',
            'image_name' => "https://em-content.zobj.net/source/microsoft-3D-fluent/406/fire-engine_1f692.png",
            'category_id' => Category::firstWhere('name', 'Safety')->id,
        ]);

        // Recreation Components
        Component::create([
            'name' => 'Park',
            'image_name' => "https://em-content.zobj.net/source/microsoft-3D-fluent/406/playground-slide_1f6dd.png",
            'category_id' => Category::firstWhere('name', 'Recreation')->id,
        ]);

        Component::create([
            'name' => 'Cinema',
            'image_name' => "https://em-content.zobj.net/source/microsoft-3D-fluent/406/film-projector_1f4fd-fe0f.png",
            'category_id' => Category::firstWhere('name', 'Recreation')->id,
        ]);

        Component::create([
            'name' => 'Sports Park',
            'image_name' => "https://em-content.zobj.net/source/microsoft-3D-fluent/406/soccer-ball_26bd.png",
            'category_id' => Category::firstWhere('name', 'Recreation')->id,
        ]);

        // Eco-Quality Components
        Component::create([
            'name' => 'Water Treatment',
            'image_name' => "https://em-content.zobj.net/source/microsoft-3D-fluent/406/potable-water_1f6b0.png",
            'category_id' => Category::firstWhere('name', 'Eco-Quality')->id,
        ]);

        // Services Components
        Component::create([
            'name' => 'School',
            'image_name' => "https://em-content.zobj.net/source/microsoft-3D-fluent/406/school_1f3eb.png",
            'category_id' => Category::firstWhere('name', 'Services')->id,
        ]);

        Component::create([
            'name' => 'Store',
            'image_name' => "https://em-content.zobj.net/source/microsoft-3D-fluent/406/convenience-store_1f3ea.png",
            'category_id' => Category::firstWhere('name', 'Services')->id,
        ]);

        Component::create([
            'name' => 'Hospital',
            'image_name' => "https://em-content.zobj.net/source/microsoft-3D-fluent/406/hospital_1f3e5.png",
            'category_id' => Category::firstWhere('name', 'Services')->id,
        ]);

        // Mobility Components
        Component::create([
            'name' => 'Train Station',
            'image_name' => "https://em-content.zobj.net/source/microsoft-3D-fluent/406/station_1f689.png",
            'category_id' => Category::firstWhere('name', 'Mobility')->id,
        ]);

        Component::create([
            'name' => 'Road',
            'image_name' => "https://em-content.zobj.net/source/microsoft-3D-fluent/406/motorway_1f6e3-fe0f.png",
            'category_id' => Category::firstWhere('name', 'Mobility')->id,
        ]);

        Component::create([
            'name' => 'Bicycle Path',
            'image_name' => "https://em-content.zobj.net/source/microsoft-3D-fluent/406/person-biking_1f6b4.png",
            'category_id' => Category::firstWhere('name', 'Mobility')->id,
        ]);

        Component::create([
            'name' => 'Gas Station',
            'image_name' => "https://em-content.zobj.net/source/microsoft-3D-fluent/406/fuel-pump_26fd.png",
            'category_id' => Category::firstWhere('name', 'Mobility')->id,
        ]);
    }

}
