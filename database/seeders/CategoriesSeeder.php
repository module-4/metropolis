<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $simCategories = ['Safety', 'Recreation', 'Eco-Quality', 'Services', 'Mobility'];

        foreach ($simCategories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}
