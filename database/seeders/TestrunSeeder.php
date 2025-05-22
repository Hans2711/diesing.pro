<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testrun;

class TestrunSeeder extends Seeder
{
    public function run(): void
    {
        Testrun::factory()->count(2)->create();
    }
}
