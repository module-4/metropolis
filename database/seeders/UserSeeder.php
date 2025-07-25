<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'testuser',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
