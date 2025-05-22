<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portfolio;
use App\Models\FileReference;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        Portfolio::factory()->count(3)->create()->each(function (Portfolio $portfolio) {
            FileReference::factory()->create([
                'model' => 'Portfolio',
                'foreign_id' => $portfolio->id,
            ]);
        });
    }
}
