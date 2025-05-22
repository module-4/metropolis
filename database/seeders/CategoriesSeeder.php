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
        Category::create([
            'name' => 'Safety',
        ]);

        Category::create([
            'name' => 'Recreation',
        ]);

        Category::create([
            'name' => 'Environmental Quality',
        ]);

        Category::create([
            'name' => 'Services',
        ]);
    }
}
