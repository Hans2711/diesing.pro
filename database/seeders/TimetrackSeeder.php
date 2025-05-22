<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Timetrack;

class TimetrackSeeder extends Seeder
{
    public function run(): void
    {
        Timetrack::factory()->count(2)->create();
    }
}
