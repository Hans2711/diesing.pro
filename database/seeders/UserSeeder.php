<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'username' => 'tester',
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->count(4)->create();
    }
}
