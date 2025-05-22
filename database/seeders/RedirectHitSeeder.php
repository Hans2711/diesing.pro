<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RedirectHit;

class RedirectHitSeeder extends Seeder
{
    public function run(): void
    {
        RedirectHit::factory()->count(2)->create();
    }
}
