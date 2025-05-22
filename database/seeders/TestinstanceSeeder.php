<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testinstance;

class TestinstanceSeeder extends Seeder
{
    public function run(): void
    {
        Testinstance::factory()->count(2)->create();
    }
}
